<?php

namespace Warcott\Support;

use Warcott\Client;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Support\ServiceProvider;
use Psr\Container\ContainerInterface;

/**
 * Class LaravelServiceProvider
 * @package Warcott\Support
 */
class LaravelServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Boot the service provider.
     */
    public function boot()
    {
        $this->setupConfigs();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->registerClient();
        $this->app->alias('warcottApi', Client::class);
    }

    /**
     * Register the Client instance.
     *
     * @return void
     */
    protected function registerClient(): void
    {
        $this->app->singleton('warcottApi', function (ContainerInterface $app) {

            /** @var Repository $config */
            $config = $app['config'];

            $verify = $config->get("warcott.verifyAccessPointSsl", false);
            $url = $config->get("warcott.url");
            $token = $config->get("warcott.token");

            $guzzleClient = new \GuzzleHttp\Client([
                'base_uri' => $url,
                'verify'   => $verify,
                'timeout' => 10,
                'headers' => [
                    'Content-Type'  => 'application/json',
                    'Authorization' => 'Bearer ' . $token
                ]
            ]);

            return new Client($guzzleClient);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return ['warcottApi', Client::class];
    }

    /**
     * @return void
     */
    private function setupConfigs(): void
    {
        $source = realpath(__DIR__ . '/../../config/warcott.php');
        $destination = $this->app->basePath() . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'warcott.php';
        $this->publishes([$source => $destination], 'warcott');
        $this->mergeConfigFrom($source, 'warcott');
    }
}
