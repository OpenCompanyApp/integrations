<?php

namespace OpenCompany\Integrations\RedisCloud;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\RedisCloud\Tools\RedisCloudGetCurrentAccount;
use OpenCompany\Integrations\RedisCloud\Tools\RedisCloudListSubscriptions;
use OpenCompany\Integrations\RedisCloud\Tools\RedisCloudGetSubscription;
use OpenCompany\Integrations\RedisCloud\Tools\RedisCloudListDatabases;
use OpenCompany\Integrations\RedisCloud\Tools\RedisCloudGetDatabase;
use OpenCompany\Integrations\RedisCloud\Tools\RedisCloudListTeams;
use OpenCompany\Integrations\RedisCloud\Tools\RedisCloudGetTeam;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class RedisCloudToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'api_key',
            'legacy_auth_type' => 'api_key',
            'credential_mode' => 'secret',
            'setup_flows' =>
            [
              0 => 'manual_secret',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
            ],
            'notes' =>
            [
            ],
          ],
          'host_availability' => [
            'web' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_secret',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_secret',
              'runtime_mode' => 'normal',
            ],
          ],
          'runtime_requirements' => [
          ],
          'compatibility' => [
            'web_setup_supported' => true,
            'web_runtime_supported' => true,
            'cli_setup_supported' => true,
            'cli_runtime_supported' => true,
          ],
        ];
    }




/**
     * Application identifier used for credential resolution.
     */
    public function appName(): string
    {
        return 'redis-cloud';
    }

/**
     * Short metadata shown in tool listings and navigation.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'subscriptions, databases, teams, account',
            'description' => 'Redis Cloud managed hosting',
            'icon' => 'ph:cloud',
            'logo' => 'simple-icons:redis',
        ];
    }

/**
     * Extended metadata shown on the integration detail page.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Redis Cloud',
            'description' => 'Managed Redis hosting — manage subscriptions, databases, teams, and account settings via the Redis Cloud REST API.',
            'icon' => 'ph:cloud',
            'logo' => 'simple-icons:redis',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://redis.io/docs/latest/operate/rc/api/',
        ];
    }/**
     * Configuration schema for the integration settings form.
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Redis Cloud API key',
                'hint' => 'Generate an API key in the Redis Cloud console at <code>app.redislabs.com</code> under Settings > API Keys',
                'required' => true,
            ],
            [
                'key' => 'secret_key',
                'type' => 'secret',
                'label' => 'Secret Key',
                'placeholder' => 'Enter your Redis Cloud API secret key',
                'hint' => 'The secret key paired with your API key, shown once when the key is created',
                'required' => true,
            ],
        ];
    }

    /**
     * Verify connectivity by hitting the current account endpoint.
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $secretKey = $config['secret_key'] ?? '';

        if (empty($apiKey) || empty($secretKey)) {
            return ['success' => false, 'error' => 'API key and secret key are required'];
        }

        try {
            $response = Http::withBasicAuth($apiKey, $secretKey)
                ->withHeaders([
                    'Accept' => 'application/json',
                ])
                ->timeout(10)
                ->get('https://api.redislabs.com/v1/accounts/current');

            if (!$response->successful()) {
                $error = $response->json('description')
                    ?? $response->json('error')
                    ?? $response->body();

                return [
                    'success' => false,
                    'error' => 'Redis Cloud API error (' . $response->status() . '): '
                        . (is_string($error) ? $error : json_encode($error)),
                ];
            }

            $account = $response->json();
            $owner = $account['ownerEmail'] ?? $account['owner'] ?? 'unknown';

            return [
                'success' => true,
                'message' => "Connected to Redis Cloud (account owner: {$owner}).",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Validation rules for the configuration fields.
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'secret_key' => 'nullable|string',
        ];
    }

    /**
     * Register all Redis Cloud tools.
     */
    public function tools(): array
    {
        return [
            'redis_cloud_get_current_account' => [
                'class' => RedisCloudGetCurrentAccount::class,
                'type' => 'read',
                'name' => 'Get Current Account',
                'description' => 'Get the current Redis Cloud account information.',
                'icon' => 'ph:user',
            ],
            'redis_cloud_list_subscriptions' => [
                'class' => RedisCloudListSubscriptions::class,
                'type' => 'read',
                'name' => 'List Subscriptions',
                'description' => 'List all subscriptions in the Redis Cloud account.',
                'icon' => 'ph:folder',
            ],
            'redis_cloud_get_subscription' => [
                'class' => RedisCloudGetSubscription::class,
                'type' => 'read',
                'name' => 'Get Subscription',
                'description' => 'Get details for a specific Redis Cloud subscription.',
                'icon' => 'ph:folder-open',
            ],
            'redis_cloud_list_databases' => [
                'class' => RedisCloudListDatabases::class,
                'type' => 'read',
                'name' => 'List Databases',
                'description' => 'List all databases within a Redis Cloud subscription.',
                'icon' => 'ph:database',
            ],
            'redis_cloud_get_database' => [
                'class' => RedisCloudGetDatabase::class,
                'type' => 'read',
                'name' => 'Get Database',
                'description' => 'Get details for a specific Redis Cloud database.',
                'icon' => 'ph:database',
            ],
            'redis_cloud_list_teams' => [
                'class' => RedisCloudListTeams::class,
                'type' => 'read',
                'name' => 'List Teams',
                'description' => 'List all teams (ACL roles) in the Redis Cloud account.',
                'icon' => 'ph:users',
            ],
            'redis_cloud_get_team' => [
                'class' => RedisCloudGetTeam::class,
                'type' => 'read',
                'name' => 'Get Team',
                'description' => 'Get details for a specific Redis Cloud team (ACL role).',
                'icon' => 'ph:users',
            ],
        ];
    }

    /**
     * Path to the Lua documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/redis-cloud.md';
    }

    /**
     * Credential fields for the integration.
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'secret_key', 'type' => 'secret', 'label' => 'Secret Key', 'required' => true],
        ];
    }

    /**
     * Confirm this class represents an integration.
     */
    public function isIntegration(): bool
    {        return true;
    }

    /**
     * Instantiate a tool with an optionally scoped RedisCloudService.
     *
     * When an account context is provided the service is built from that
     * account's resolved credentials; otherwise the container singleton is
     * used.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            $service = new RedisCloudService(
                apiKey: $creds->get('redis-cloud', 'api_key', '', $account),
                secretKey: $creds->get('redis-cloud', 'secret_key', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(RedisCloudService::class));
    }
}
