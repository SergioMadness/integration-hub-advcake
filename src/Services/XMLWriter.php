<?php namespace professionalweb\IntegrationHub\IntegrationHubAdvCake\Services;

use professionalweb\IntegrationHub\IntegrationHubAdvCake\Interfaces\Models\Item;
use professionalweb\IntegrationHub\IntegrationHubAdvCake\Interfaces\Services\Writer;

/**
 * Service to add items to file
 * @package professionalweb\IntegrationHub\IntegrationHubAdvCake\Services
 */
class XMLWriter implements Writer
{
    /** @var string */
    private $path;

    /** @var \XMLWriter */
    private $xmlWriter;

    /**
     * Set path to file
     *
     * @param string $path
     *
     * @return $this
     */
    public function setPath(string $path): Writer
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path to file
     *
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * Write object
     *
     * @param Item $item
     *
     * @return $this
     */
    public function write(Item $item): Writer
    {
        $xml = $this->getFileDescriptor();
        $xml->startElement('order');
        $xml->writeElement('orderId', $item->getId());
        $xml->writeElement('orderPrice', $item->getPrice());
        $xml->writeElement('orderStatus', $item->getStatus());
        $xml->writeElement('orderTrackid', $item->getTrackId());
        $xml->writeElement('description', $item->getDescription());
        $xml->writeElement('coupon', $item->getPromoCode());
        $xml->writeElement('dateCreate', $item->getCreatedAt());
        $xml->writeElement('dateLastChange', $item->getUpdatedAt());
        $xml->writeElement('url', $item->getUrl());
        $xml->writeElement('orderBasket', $item->getOrderBasketStr());
        $xml->endElement();
        $xml->flush();

        return $this;
    }

    protected function getFileDescriptor(): \XMLWriter
    {
        if ($this->xmlWriter === null) {
            $this->xmlWriter = new \XMLWriter();
            $this->xmlWriter->openUri($this->getPath());
            $this->xmlWriter->startDocument("1.0");
            $this->xmlWriter->startElement('orders');
        }

        return $this->xmlWriter;
    }

    /**
     * Save|close file
     */
    public function save(): void
    {
        $descriptor = $this->getFileDescriptor();
        $descriptor->endElement();
        $descriptor->flush();
    }

    public function __destruct()
    {
        if ($this->xmlWriter !== null) {
            unset($this->xmlWriter);
        }
    }
}
