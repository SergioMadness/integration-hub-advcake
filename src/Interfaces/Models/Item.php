<?php namespace professionalweb\IntegrationHub\IntegrationHubAdvCake\Interfaces\Models;

/**
 * Interface for items to export
 * @package professionalweb\IntegrationHub\IntegrationHubAdvCake\Interfaces
 */
interface Item
{
    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @return float
     */
    public function getPrice(): float;

    /**
     * <orderStatus>1</orderStatus> ‐ Pending
     * <orderStatus>2</orderStatus> ‐ Approved
     * <orderStatus>3</orderStatus> ‐ Canceled
     *
     * @return string
     */
    public function getStatus(): string;

    /**
     * AdvCake cookie value
     *
     * @return string
     */
    public function getTrackId(): string;

    /**
     * @return string
     */
    public function getCreatedAt(): string;

    /**
     * @return string
     */
    public function getUpdatedAt(): string;

    /**
     * @return string
     */
    public function getDescription(): string;

    /**
     * @return string
     */
    public function getPromoCode(): string;

    /**
     * @return string
     */
    public function getUrl(): string;
}