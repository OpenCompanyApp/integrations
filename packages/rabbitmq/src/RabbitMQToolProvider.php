<?php

namespace OpenCompany\Integrations\RabbitMQ;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQListQueues;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQGetQueue;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQListExchanges;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQListConnections;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQListVhosts;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQGetOverview;

/**
 * Tool provider for the RabbitMQ Management API integration.
 *
 * Implements {@see ConfigurableIntegration} to expose the config schema,
 * credential fields, validation rules, and connection test required by
 * the OpenCompany integration platform. Supports multi-account via the
 * account-aware {@see CredentialResolver}.
 */
class RabbitMQToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * Machine name of the integration.
     */
    public function appName(): string
    {
        return 'rabbitmq';
    }

    /**
     * Short metadata shown in tool listings.
     *
     * @return array{label: string, description: string, icon: string, logo: string}
     */
    public function appMeta(): array
    {
        return [
            'label'       => 'queues, exchanges, connections, vhosts, overview',
            'description' => 'Message broker monitoring',
            'icon'        => 'ph:rabbit',
            'logo'        => 'simple-icons:rabbitmq',
        ];
    }

    /**
     * Full integration metadata for the integrations catalogue.
     *
     * @return array{name: string, description: string, icon: string, logo: string, category: string, badge: string, docs_url: string}
     */
    public function integrationMeta(): array
    {
        return [
            'name'        => 'RabbitMQ',
            'description' => 'Monitor RabbitMQ message broker queues, exchanges, connections, and cluster health',
            'icon'        => 'ph:rabbit',
            'logo'        => 'simple-icons:rabbitmq',
            'category'    => 'messaging',
            'badge'       => 'verified',
            'docs_url'    => 'https://www.rabbitmq.com/docs/management',
        ];
    }

    /**
     * Configuration schema for the integration settings UI.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key'         => 'username',
                'type'        => 'string',
                'label'       => 'Username',
                'placeholder' => 'guest',
                'hint'        => 'RabbitMQ management user. Avoid using the default <code>guest</code> account in production.',
                'required'    => true,
            ],
            [
                'key'         => 'password',
                'type'        => 'secret',
                'label'       => 'Password',
                'placeholder' => 'Enter your RabbitMQ password',
                'hint'        => 'Password for the RabbitMQ management user',
                'required'    => true,
            ],
            [
                'key'         => 'hostname',
                'type'        => 'url',
                'label'       => 'Management URL',
                'placeholder' => 'http://localhost:15672',
                'hint'        => 'Full URL of the RabbitMQ Management API (e.g. <code>https://rabbitmq.example.com</code>). The default port is 15672 for non-TLS.',
                'default'     => 'http://localhost:15672',
                'required'    => true,
            ],
        ];
    }

    /**
     * Test the connection to the RabbitMQ Management API.
     *
     * @param array<string, mixed> $config Configuration values to test.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $username = $config['username'] ?? '';
        $password = $config['password'] ?? '';
        $baseUrl  = rtrim($config['hostname'] ?? 'http://localhost:15672', '/');

        if (empty($username) || empty($password)) {
            return ['success' => false, 'error' => 'Username and password are required.'];
        }

        try {
            $response = Http::withBasicAuth($username, $password)
                ->timeout(10)
                ->get($baseUrl . '/api/overview');

            if ($response->status() === 401) {
                return ['success' => false, 'error' => 'Authentication failed. Check your username and password.'];
            }

            if (!$response->successful()) {
                return [
                    'success' => false,
                    'error'   => "RabbitMQ API returned HTTP {$response->status()}. Check the Management URL.",
                ];
            }

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error'   => "Could not parse a JSON response from {$baseUrl}/api/overview. Check the Management URL.",
                ];
            }

            $node = $json['node'] ?? 'unknown';
            $version = $json['rabbitmq_version'] ?? 'unknown';

            return [
                'success' => true,
                'message' => "Connected to RabbitMQ node {$node} (v{$version}).",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Laravel validation rules for stored configuration.
     *
     * @return array<string, string|array<int, string>>
     */
    public function validationRules(): array
    {
        return [
            'username' => 'required|string',
            'password' => 'required|string',
            'hostname' => 'required|url',
        ];
    }

    /**
     * Registered tools for this integration.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'rabbitmq_list_queues' => [
                'class'       => RabbitMQListQueues::class,
                'type'        => 'read',
                'name'        => 'List Queues',
                'description' => 'List all queues across all virtual hosts.',
                'icon'        => 'ph:list-bullets',
            ],
            'rabbitmq_get_queue' => [
                'class'       => RabbitMQGetQueue::class,
                'type'        => 'read',
                'name'        => 'Get Queue',
                'description' => 'Get detailed information about a specific queue.',
                'icon'        => 'ph:list-bullets',
            ],
            'rabbitmq_list_exchanges' => [
                'class'       => RabbitMQListExchanges::class,
                'type'        => 'read',
                'name'        => 'List Exchanges',
                'description' => 'List all exchanges across all virtual hosts.',
                'icon'        => 'ph:arrows-split',
            ],
            'rabbitmq_list_connections' => [
                'class'       => RabbitMQListConnections::class,
                'type'        => 'read',
                'name'        => 'List Connections',
                'description' => 'List all active AMQP connections.',
                'icon'        => 'ph:plug',
            ],
            'rabbitmq_list_vhosts' => [
                'class'       => RabbitMQListVhosts::class,
                'type'        => 'read',
                'name'        => 'List Vhosts',
                'description' => 'List all virtual hosts.',
                'icon'        => 'ph:folders',
            ],
            'rabbitmq_get_overview' => [
                'class'       => RabbitMQGetOverview::class,
                'type'        => 'read',
                'name'        => 'Get Overview',
                'description' => 'Get cluster overview — node info, message rates, queue totals.',
                'icon'        => 'ph:chart-bar',
            ],
        ];
    }

    /**
     * Absolute path to the Lua docs markdown file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/rabbitmq.md';
    }

    /**
     * Credential field definitions for quick-connect setups.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'username', 'type' => 'string', 'label' => 'Username', 'required' => true],
            ['key' => 'password', 'type' => 'secret', 'label' => 'Password', 'required' => true],
            ['key' => 'hostname', 'type' => 'url', 'label' => 'Management URL', 'required' => true, 'default' => 'http://localhost:15672'],
        ];
    }

    /**
     * Whether this class represents an integration (always true).
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally scoped to a specific account.
     *
     * @param class-string<Tool> $class   Fully-qualified tool class name.
     * @param array<string, mixed> $context Context with optional 'account' key for multi-account.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new RabbitMQService(
                username: $creds->get('rabbitmq', 'username', '', $account),
                password: $creds->get('rabbitmq', 'password', '', $account),
                baseUrl:  $creds->get('rabbitmq', 'hostname', 'http://localhost:15672', $account),
            );

            return new $class($service);
        }

        return new $class(app(RabbitMQService::class));
    }
}
