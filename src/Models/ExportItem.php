<?php namespace professionalweb\IntegrationHub\IntegrationHubAdvCake\Models;

use professionalweb\IntegrationHub\IntegrationHubAdvCake\Interfaces\Models\Item;

/**
 * Model for export
 * @package professionalweb\IntegrationHub\IntegrationHubAdvCake\Models
 */
class ExportItem implements Item
{
    /** @var string */
    private $id;

    /** @var float */
    private $price;

    /** @var string */
    private $status;

    /** @var string */
    private $trackId;

    /** @var string */
    private $createdAt;

    /** @var string */
    private $updatedAt;

    /** @var string */
    private $description;

    /** @var string */
    private $promoCode;

    /** @var string */
    private $url;

    /** @var array */
    private $orderBasket;

    /**
     * @param string $id
     *
     * @return ExportItem
     */
    public function setId(string $id): ExportItem
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @param float $price
     *
     * @return ExportItem
     */
    public function setPrice(float $price): ExportItem
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @param string $status
     *
     * @return ExportItem
     */
    public function setStatus(string $status): ExportItem
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @param string $trackId
     *
     * @return ExportItem
     */
    public function setTrackId(string $trackId): ExportItem
    {
        $this->trackId = $trackId;

        return $this;
    }

    /**
     * @param string $createdAt
     *
     * @return ExportItem
     */
    public function setCreatedAt(string $createdAt): ExportItem
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @param string $updatedAt
     *
     * @return ExportItem
     */
    public function setUpdatedAt(string $updatedAt): ExportItem
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @param string $description
     *
     * @return ExportItem
     */
    public function setDescription(string $description): ExportItem
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @param string $promoCode
     *
     * @return ExportItem
     */
    public function setPromoCode(string $promoCode): ExportItem
    {
        $this->promoCode = $promoCode;

        return $this;
    }

    /**
     * @param string $url
     *
     * @return ExportItem
     */
    public function setUrl(string $url): ExportItem
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * <orderStatus>1</orderStatus> ‐ Pending
     * <orderStatus>2</orderStatus> ‐ Approved
     * <orderStatus>3</orderStatus> ‐ Canceled
     *
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * AdvCake cookie value
     *
     * @return string
     */
    public function getTrackId(): string
    {
        return $this->trackId;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getPromoCode(): string
    {
        return $this->promoCode;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return array
     */
    public function getOrderBasket(): array
    {
        return $this->orderBasket;
    }

    /**
     * @param array $orderBasket
     *
     * @return ExportItem
     */
    public function setOrderBasket(array $orderBasket): ExportItem
    {
        $this->orderBasket = $orderBasket;

        return $this;
    }

    /**
     * @return string
     */
    public function getOrderBasketStr(): string
    {
        return (string)json_encode($this->orderBasket);
    }
}