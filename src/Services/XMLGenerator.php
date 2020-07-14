<?php namespace professionalweb\IntegrationHub\IntegrationHubAdvCake\Services;

use Illuminate\Support\Carbon;
use professionalweb\IntegrationHub\IntegrationHubAdvCake\Models\ExportItem;
use professionalweb\IntegrationHub\IntegrationHubAdvCake\Interfaces\Models\Item;
use professionalweb\IntegrationHub\IntegrationHubAggregation\Models\db\Aggregation;
use professionalweb\IntegrationHub\IntegrationHubAdvCake\Interfaces\Services\Writer;
use professionalweb\IntegrationHub\IntegrationHubAdvCake\Interfaces\Services\Generator;
use professionalweb\IntegrationHub\IntegrationHubAggregation\Traits\UseAggregationRepository;
use professionalweb\IntegrationHub\IntegrationHubAggregation\Interfaces\Repositories\AggregationRepository;

/**
 * Service to generate XML
 * @package professionalweb\IntegrationHub\IntegrationHubAdvCake\Services
 */
class XMLGenerator implements Generator
{
    use UseAggregationRepository;

    /** @var Writer */
    private $writer;

    public function __construct(AggregationRepository $repository, Writer $writer)
    {
        $this->setAggregationRepository($repository)->setWriter($writer);
    }

    /**
     * Generate XML
     *
     * @param string|null $since
     * @param string|null $till
     *
     * @return string Path to file
     */
    public function generate(?string $since = null, ?string $till = null): string
    {
        $repository = $this->getAggregationRepository();

        $limit = 100;
        $offset = 0;

        $filter = [];
        if (!empty($since)) {
            $filter[] = ['created_at', '>=', $since];
        }
        if (!empty($till)) {
            $filter[] = ['created_at', '<=', $till];
        }

        $namespace = config('advcake.namespace');
        $fileName = 'all.xml';
        if ($since !== null || $till !== null) {
            $fileName = $since . '-' . $till . '.xml';
        }

        $lastModified = $repository->getLastItemDate($namespace);
        if ($lastModified !== null && ($path = $this->getCache($fileName, $lastModified)) !== null) {
            return $path;
        }

        $qty = $repository->count($filter);
        if ($qty === 0) {
            return '';
        }
        $iterations = ceil($qty / $limit);

        $writer = $this->getWriter()->setPath(\Storage::disk('advCake')->url($fileName));

        for ($i = 0; $i < $iterations; $i++) {
            $items = $repository->get($filter, ['created_at' => 'desc'], $limit, $offset);
            /** @var Aggregation $item */
            foreach ($items as $item) {
                $writer->write($this->prepareItem($item));
            }
            $offset += $limit;
        }

        $writer->save();

        return $fileName;
    }

    /**
     * Create export item
     *
     * @param Aggregation $model
     *
     * @return Item
     */
    protected function prepareItem(Aggregation $model): Item
    {
        $data = $this->mapData($model->data, config('advcake.mapping', []));

        return (new ExportItem())
            ->setId($model->item_id)
            ->setCreatedAt($model->created_at)
            ->setUpdatedAt($model->updated_at)
            ->setDescription($data['description'])
            ->setPrice((float)$data['price'])
            ->setPromoCode($data['promoCode'])
            ->setStatus($data['status'])
            ->setTrackId($data['trackId'])
            ->setUrl($data['url']);
    }

    /**
     * Get cached file
     *
     * @param string $fileName
     *
     * @param Carbon $deadLine Last lead date
     *
     * @return string|null
     */
    protected function getCache(string $fileName, Carbon $deadLine): ?string
    {
        $disk = \Storage::disk('advCake');
        if ($disk->exists($fileName)) {
            if (Carbon::parse($disk->lastModified($fileName))->greaterThan($deadLine)) {
                return $disk->url($fileName);
            }
            $disk->delete($fileName);
        }

        return null;
    }

    /**
     * @return Writer
     */
    public function getWriter(): Writer
    {
        return $this->writer;
    }

    /**
     * @param Writer $writer
     *
     * @return XMLGenerator
     */
    public function setWriter(Writer $writer): XMLGenerator
    {
        $this->writer = $writer;

        return $this;
    }

    /**
     * Data mapping
     *
     * @param array $data
     * @param array $mapping
     *
     * @return array
     */
    protected function mapData(array $data, array $mapping): array
    {
        if (empty($mapping)) {
            return $data;
        }

        $result = [];

        foreach ($mapping as $from => $to) {
            $val = $data[$from] ?? '';
            if (is_array($to)) {
                if (isset($to['mapping'])) {
                    $val = str_replace(array_keys($to['mapping']), array_values($to['mapping']), $val);
                }
                $to = $to['field'];
            }
            $result[$to] = $val;
        }

        return $result;
    }
}