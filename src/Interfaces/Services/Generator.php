<?php namespace professionalweb\IntegrationHub\IntegrationHubAdvCake\Interfaces\Services;

/**
 * Interface for XML generator
 * @package professionalweb\IntegrationHub\IntegrationHubAdvCake\Services
 */
interface Generator
{
    /**
     * Generate XML
     *
     * @param string|null $since
     * @param string|null $till
     *
     * @return string Path to file
     */
    public function generate(?string $since = null, ?string $till = null): string;
}