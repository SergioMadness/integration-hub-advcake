<?php namespace professionalweb\IntegrationHub\IntegrationHubAdvCake\Interfaces\Services;

use professionalweb\IntegrationHub\IntegrationHubAdvCake\Interfaces\Models\Item;

/**
 * Interface for XML writer
 * @package professionalweb\IntegrationHub\IntegrationHubAdvCake\Interfaces\Services
 */
interface Writer
{
    /**
     * Set path to file
     *
     * @param string $path
     *
     * @return $this
     */
    public function setPath(string $path): self;

    /**
     * Write object
     *
     * @param Item $item
     *
     * @return $this
     */
    public function write(Item $item): self;

    /**
     * Close file
     */
    public function save(): void;
}
