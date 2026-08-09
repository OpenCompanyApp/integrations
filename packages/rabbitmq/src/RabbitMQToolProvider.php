<?php

namespace OpenCompany\Integrations\RabbitMQ;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQAlivenessTest;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQCloseConnection;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQCreateBinding;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQCreateVhost;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQDeclareExchange;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQDeclareQueue;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQDeleteBinding;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQDeleteExchange;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQDeletePermissions;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQDeleteQueue;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQDeleteVhost;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQExportDefinitions;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQGetChannel;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQGetConnection;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQGetExchange;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQGetMessages;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQGetNode;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQGetOverview;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQGetQueue;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQGetQueueBindings;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQGetUser;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQGetVhost;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQHealthCheck;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQImportDefinitions;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQListBindings;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQListChannels;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQListConnections;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQListConsumers;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQListExchangeDestinationBindings;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQListExchangeSourceBindings;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQListExchanges;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQListNodes;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQListPermissions;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQListPolicies;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQListQueues;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQListUsers;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQListVhostPermissions;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQListVhosts;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQPublishMessage;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQPurgeQueue;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQSetPermissions;

/**
 * Tool provider for the RabbitMQ Management HTTP API integration.
 *
 * Exposes broker monitoring and management tools for nodes, queues, exchanges,
 * bindings, vhosts, connections, channels, consumers, users, permissions, and definitions.
 */
class RabbitMQToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => [
                'strategy' => 'basic',
                'legacy_auth_type' => 'api_key',
                'credential_mode' => 'username_password',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => [],
                'notes' => [],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
            'compatibility' => [
                'web_setup_supported' => true,
                'web_runtime_supported' => true,
                'cli_setup_supported' => true,
                'cli_runtime_supported' => true,
            ],
        ];
    }

    public function appName(): string
    {
        return 'rabbitmq';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'RabbitMQ',
            'description' => 'Message broker management',
            'icon' => 'ph:rabbit',
            'logo' => 'simple-icons:rabbitmq',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'RabbitMQ',
            'description' => 'Monitor and manage RabbitMQ nodes, queues, exchanges, bindings, vhosts, connections, users, permissions, and definitions',
            'icon' => 'ph:rabbit',
            'logo' => 'simple-icons:rabbitmq',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://www.rabbitmq.com/docs/4.2/http-api-reference',
        ];
    }

    public function configSchema(): array
    {
        return [
            ['key' => 'username', 'type' => 'string', 'label' => 'Username', 'placeholder' => 'monitoring_user', 'hint' => 'RabbitMQ management username. Avoid the default guest account in production.', 'required' => true],
            ['key' => 'password', 'type' => 'secret', 'label' => 'Password', 'placeholder' => 'Enter RabbitMQ password', 'hint' => 'Password for the RabbitMQ management user.', 'required' => true],
            ['key' => 'hostname', 'type' => 'url', 'label' => 'Management URL', 'placeholder' => 'http://localhost:15672', 'hint' => 'Base URL for the RabbitMQ Management plugin HTTP API.', 'default' => 'http://localhost:15672', 'required' => true],
        ];
    }

    /**
     * Test the connection to the RabbitMQ Management API.
     *
     * @param  array<string, mixed>  $config  Configuration values to test
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $username = (string) ($config['username'] ?? '');
        $password = (string) ($config['password'] ?? '');
        $baseUrl = rtrim((string) ($config['hostname'] ?? 'http://localhost:15672'), '/');

        if ($username === '' || $password === '') {
            return ['success' => false, 'error' => 'Username and password are required.'];
        }

        try {
            $response = Http::withBasicAuth($username, $password)
                ->timeout(10)
                ->get($baseUrl . '/api/overview');

            if ($response->status() === 401) {
                return ['success' => false, 'error' => 'Authentication failed. Check the RabbitMQ username and password.'];
            }

            if (! $response->successful()) {
                return ['success' => false, 'error' => "RabbitMQ API returned HTTP {$response->status()}. Check the Management URL."];
            }

            $json = $response->json();
            if (! is_array($json)) {
                return ['success' => false, 'error' => "Could not parse JSON from {$baseUrl}/api/overview."];
            }

            $node = $json['node'] ?? 'unknown';
            $version = $json['rabbitmq_version'] ?? 'unknown';

            return ['success' => true, 'message' => "Connected to RabbitMQ node {$node} (v{$version})."];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'username' => 'required|string',
            'password' => 'required|string',
            'hostname' => 'required|url',
        ];
    }

    public function tools(): array
    {
        return [
            'rabbitmq_get_overview' => ['class' => RabbitMQGetOverview::class, 'type' => 'read', 'name' => 'Get Overview', 'description' => 'Get cluster overview.', 'icon' => 'ph:chart-bar'],
            'rabbitmq_list_nodes' => ['class' => RabbitMQListNodes::class, 'type' => 'read', 'name' => 'List Nodes', 'description' => 'List cluster nodes.', 'icon' => 'ph:hard-drives'],
            'rabbitmq_get_node' => ['class' => RabbitMQGetNode::class, 'type' => 'read', 'name' => 'Get Node', 'description' => 'Get one cluster node.', 'icon' => 'ph:hard-drive'],
            'rabbitmq_health_check' => ['class' => RabbitMQHealthCheck::class, 'type' => 'read', 'name' => 'Health Check', 'description' => 'Run a RabbitMQ health check.', 'icon' => 'ph:heartbeat'],
            'rabbitmq_aliveness_test' => ['class' => RabbitMQAlivenessTest::class, 'type' => 'read', 'name' => 'Aliveness Test', 'description' => 'Run vhost aliveness test.', 'icon' => 'ph:pulse'],
            'rabbitmq_list_queues' => ['class' => RabbitMQListQueues::class, 'type' => 'read', 'name' => 'List Queues', 'description' => 'List queues globally or per vhost.', 'icon' => 'ph:list-bullets'],
            'rabbitmq_get_queue' => ['class' => RabbitMQGetQueue::class, 'type' => 'read', 'name' => 'Get Queue', 'description' => 'Get queue details.', 'icon' => 'ph:list-magnifying-glass'],
            'rabbitmq_declare_queue' => ['class' => RabbitMQDeclareQueue::class, 'type' => 'write', 'name' => 'Declare Queue', 'description' => 'Declare or update a queue.', 'icon' => 'ph:plus-square'],
            'rabbitmq_delete_queue' => ['class' => RabbitMQDeleteQueue::class, 'type' => 'write', 'name' => 'Delete Queue', 'description' => 'Delete a queue.', 'icon' => 'ph:trash'],
            'rabbitmq_purge_queue' => ['class' => RabbitMQPurgeQueue::class, 'type' => 'write', 'name' => 'Purge Queue', 'description' => 'Purge ready queue messages.', 'icon' => 'ph:broom'],
            'rabbitmq_get_queue_bindings' => ['class' => RabbitMQGetQueueBindings::class, 'type' => 'read', 'name' => 'Get Queue Bindings', 'description' => 'List bindings for a queue.', 'icon' => 'ph:link'],
            'rabbitmq_get_messages' => ['class' => RabbitMQGetMessages::class, 'type' => 'write', 'name' => 'Get Messages', 'description' => 'Get messages from a queue.', 'icon' => 'ph:envelope-open'],
            'rabbitmq_list_exchanges' => ['class' => RabbitMQListExchanges::class, 'type' => 'read', 'name' => 'List Exchanges', 'description' => 'List exchanges globally or per vhost.', 'icon' => 'ph:arrows-split'],
            'rabbitmq_get_exchange' => ['class' => RabbitMQGetExchange::class, 'type' => 'read', 'name' => 'Get Exchange', 'description' => 'Get exchange details.', 'icon' => 'ph:arrows-left-right'],
            'rabbitmq_declare_exchange' => ['class' => RabbitMQDeclareExchange::class, 'type' => 'write', 'name' => 'Declare Exchange', 'description' => 'Declare or update an exchange.', 'icon' => 'ph:plus-circle'],
            'rabbitmq_delete_exchange' => ['class' => RabbitMQDeleteExchange::class, 'type' => 'write', 'name' => 'Delete Exchange', 'description' => 'Delete an exchange.', 'icon' => 'ph:x-circle'],
            'rabbitmq_publish_message' => ['class' => RabbitMQPublishMessage::class, 'type' => 'write', 'name' => 'Publish Message', 'description' => 'Publish via management API.', 'icon' => 'ph:paper-plane-tilt'],
            'rabbitmq_list_exchange_source_bindings' => ['class' => RabbitMQListExchangeSourceBindings::class, 'type' => 'read', 'name' => 'List Source Bindings', 'description' => 'List exchange source bindings.', 'icon' => 'ph:arrow-fat-lines-right'],
            'rabbitmq_list_exchange_destination_bindings' => ['class' => RabbitMQListExchangeDestinationBindings::class, 'type' => 'read', 'name' => 'List Destination Bindings', 'description' => 'List exchange destination bindings.', 'icon' => 'ph:arrow-fat-lines-left'],
            'rabbitmq_list_bindings' => ['class' => RabbitMQListBindings::class, 'type' => 'read', 'name' => 'List Bindings', 'description' => 'List bindings.', 'icon' => 'ph:link-simple'],
            'rabbitmq_create_binding' => ['class' => RabbitMQCreateBinding::class, 'type' => 'write', 'name' => 'Create Binding', 'description' => 'Create a binding.', 'icon' => 'ph:link-simple-horizontal'],
            'rabbitmq_delete_binding' => ['class' => RabbitMQDeleteBinding::class, 'type' => 'write', 'name' => 'Delete Binding', 'description' => 'Delete a binding.', 'icon' => 'ph:link-break'],
            'rabbitmq_list_connections' => ['class' => RabbitMQListConnections::class, 'type' => 'read', 'name' => 'List Connections', 'description' => 'List AMQP connections.', 'icon' => 'ph:plug'],
            'rabbitmq_get_connection' => ['class' => RabbitMQGetConnection::class, 'type' => 'read', 'name' => 'Get Connection', 'description' => 'Get one connection.', 'icon' => 'ph:plugs-connected'],
            'rabbitmq_close_connection' => ['class' => RabbitMQCloseConnection::class, 'type' => 'write', 'name' => 'Close Connection', 'description' => 'Close a connection.', 'icon' => 'ph:plugs'],
            'rabbitmq_list_channels' => ['class' => RabbitMQListChannels::class, 'type' => 'read', 'name' => 'List Channels', 'description' => 'List channels.', 'icon' => 'ph:circles-three-plus'],
            'rabbitmq_get_channel' => ['class' => RabbitMQGetChannel::class, 'type' => 'read', 'name' => 'Get Channel', 'description' => 'Get one channel.', 'icon' => 'ph:circle'],
            'rabbitmq_list_consumers' => ['class' => RabbitMQListConsumers::class, 'type' => 'read', 'name' => 'List Consumers', 'description' => 'List consumers.', 'icon' => 'ph:users-three'],
            'rabbitmq_list_vhosts' => ['class' => RabbitMQListVhosts::class, 'type' => 'read', 'name' => 'List Vhosts', 'description' => 'List virtual hosts.', 'icon' => 'ph:folders'],
            'rabbitmq_get_vhost' => ['class' => RabbitMQGetVhost::class, 'type' => 'read', 'name' => 'Get Vhost', 'description' => 'Get one virtual host.', 'icon' => 'ph:folder-open'],
            'rabbitmq_create_vhost' => ['class' => RabbitMQCreateVhost::class, 'type' => 'write', 'name' => 'Create Vhost', 'description' => 'Create or update virtual host.', 'icon' => 'ph:folder-plus'],
            'rabbitmq_delete_vhost' => ['class' => RabbitMQDeleteVhost::class, 'type' => 'write', 'name' => 'Delete Vhost', 'description' => 'Delete virtual host.', 'icon' => 'ph:folder-minus'],
            'rabbitmq_list_vhost_permissions' => ['class' => RabbitMQListVhostPermissions::class, 'type' => 'read', 'name' => 'List Vhost Permissions', 'description' => 'List permissions for a vhost.', 'icon' => 'ph:shield-check'],
            'rabbitmq_list_users' => ['class' => RabbitMQListUsers::class, 'type' => 'read', 'name' => 'List Users', 'description' => 'List users.', 'icon' => 'ph:users'],
            'rabbitmq_get_user' => ['class' => RabbitMQGetUser::class, 'type' => 'read', 'name' => 'Get User', 'description' => 'Get one user.', 'icon' => 'ph:user'],
            'rabbitmq_list_permissions' => ['class' => RabbitMQListPermissions::class, 'type' => 'read', 'name' => 'List Permissions', 'description' => 'List all permissions.', 'icon' => 'ph:shield'],
            'rabbitmq_set_permissions' => ['class' => RabbitMQSetPermissions::class, 'type' => 'write', 'name' => 'Set Permissions', 'description' => 'Set vhost permissions.', 'icon' => 'ph:shield-plus'],
            'rabbitmq_delete_permissions' => ['class' => RabbitMQDeletePermissions::class, 'type' => 'write', 'name' => 'Delete Permissions', 'description' => 'Delete vhost permissions.', 'icon' => 'ph:shield-slash'],
            'rabbitmq_list_policies' => ['class' => RabbitMQListPolicies::class, 'type' => 'read', 'name' => 'List Policies', 'description' => 'List policies.', 'icon' => 'ph:scroll'],
            'rabbitmq_export_definitions' => ['class' => RabbitMQExportDefinitions::class, 'type' => 'read', 'name' => 'Export Definitions', 'description' => 'Export broker definitions.', 'icon' => 'ph:download-simple'],
            'rabbitmq_import_definitions' => ['class' => RabbitMQImportDefinitions::class, 'type' => 'write', 'name' => 'Import Definitions', 'description' => 'Import broker definitions.', 'icon' => 'ph:upload-simple'],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/rabbitmq.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'username', 'type' => 'string', 'label' => 'Username', 'required' => true],
            ['key' => 'password', 'type' => 'secret', 'label' => 'Password', 'required' => true],
            ['key' => 'hostname', 'type' => 'url', 'label' => 'Management URL', 'required' => true, 'default' => 'http://localhost:15672'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally scoped to a specific account.
     *
     * @param  string  $class  Tool class name
     * @param  array<string, mixed>  $context  Optional account context
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve RabbitMQ service for default or named-account credentials.
     *
     * @param  array<string, mixed>  $context  Optional account context
     */
    private function resolveService(array $context = []): RabbitMQService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new RabbitMQService(
                username: $creds->get('rabbitmq', 'username', '', $account),
                password: $creds->get('rabbitmq', 'password', '', $account),
                baseUrl: $creds->get('rabbitmq', 'hostname', 'http://localhost:15672', $account),
            );
        }

        return app(RabbitMQService::class);
    }
}
