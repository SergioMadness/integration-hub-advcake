<?php namespace professionalweb\IntegrationHub\IntegrationHubAdvCake\Providers;

use Illuminate\Support\ServiceProvider;
use professionalweb\IntegrationHub\IntegrationHubAdvCake\Services\XMLWriter;
use professionalweb\IntegrationHub\IntegrationHubAdvCake\Services\XMLGenerator;
use professionalweb\IntegrationHub\IntegrationHubAdvCake\Interfaces\Services\Writer;
use professionalweb\IntegrationHub\IntegrationHubAdvCake\Interfaces\Services\Generator;

class IntegrationHubAdvCakeProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
        $this->publishes([
            __DIR__ . '/../config/advcake.php' => config_path('advcake.php'),
        ]);
    }

    public function register(): void
    {
        $this->app->bind(Writer::class, XMLWriter::class);
        $this->app->bind(Generator::class, XMLGenerator::class);
    }
}