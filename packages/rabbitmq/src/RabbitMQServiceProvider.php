<?php

namespace OpenCompany\Integrations\RabbitMQ;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the RabbitMQ integration.
 *
 * Registers the {@see RabbitMQService} singleton resolved from stored
 * credentials and boots the {@see RabbitMQToolProvider} into the
 * {@see ToolProviderRegistry}.
 */
class RabbitMQServiceProvider extends ServiceProvider
{
    /**
     * Register the RabbitMQ service into the container.
     */
    public function register(): void
    {
        $this->app->singleton(RabbitMQService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new RabbitMQService(
                username: $creds->get('rabbitmq', 'username', ''),
                password: $creds->get('rabbitmq', 'password', ''),
                baseUrl:  $creds->get('rabbitmq', 'hostname', 'http://localhost:15672'),
            );
        });
    }

    /**
     * Boot the service provider and register the tool provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new RabbitMQToolProvider());
        }
    }
}
