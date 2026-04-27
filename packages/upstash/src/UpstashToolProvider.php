<?php

namespace OpenCompany\Integrations\Upstash;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Upstash\Tools\UpstashDeleteKey;
use OpenCompany\Integrations\Upstash\Tools\UpstashGetDatabase;
use OpenCompany\Integrations\Upstash\Tools\UpstashGetCurrentUser;
use OpenCompany\Integrations\Upstash\Tools\UpstashGetKey;
use OpenCompany\Integrations\Upstash\Tools\UpstashListDatabases;
use OpenCompany\Integrations\Upstash\Tools\UpstashListKeys;
use OpenCompany\Integrations\Upstash\Tools\UpstashSetKey;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class UpstashToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'upstash';
    }

/**
     * Short metadata shown in tool listings and navigation.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'get, set, delete, keys, databases',
            'description' => 'Serverless Redis',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:upstash',
        ];
    }

/**
     * Extended metadata shown on the integration detail page.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Upstash Redis',
            'description' => 'Serverless Redis with REST API — manage keys, databases, and teams.',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:upstash',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://docs.upstash.com/redis',
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
                'placeholder' => 'Enter your Upstash API key',
                'hint' => 'Find your API key in the Upstash console at <code>upstash.com</code>',
                'required' => true,
            ],
            [
                'key' => 'redis_url',
                'type' => 'url',
                'label' => 'Redis REST URL',
                'placeholder' => 'https://xxx-12345.upstash.io',
                'hint' => 'The REST API URL for your Upstash Redis database (from the database detail page)',
                'required' => true,
            ],
        ];
    }

    /**
     * Verify connectivity by hitting the Redis REST API /info endpoint.
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $redisUrl = rtrim($config['redis_url'] ?? '', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        if (empty($redisUrl)) {
            return ['success' => false, 'error' => 'No Redis URL provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($redisUrl . '/info');

            if (!$response->successful()) {
                $error = $response->json('error') ?? $response->body();

                return [
                    'success' => false,
                    'error' => 'Upstash API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Upstash Redis at {$redisUrl}.",
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
            'redis_url' => 'nullable|url',
        ];
    }

    /**
     * Register all Upstash tools.
     */
    public function tools(): array
    {
        return [
            'upstash_get_key' => [
                'class' => UpstashGetKey::class,
                'type' => 'read',
                'name' => 'Get Key',
                'description' => 'Retrieve a value from Redis by key.',
                'icon' => 'ph:key',
            ],
            'upstash_set_key' => [
                'class' => UpstashSetKey::class,
                'type' => 'write',
                'name' => 'Set Key',
                'description' => 'Store a key-value pair in Redis with an optional TTL.',
                'icon' => 'ph:floppy-disk',
            ],
            'upstash_delete_key' => [
                'class' => UpstashDeleteKey::class,
                'type' => 'write',
                'name' => 'Delete Key',
                'description' => 'Delete a key from Redis.',
                'icon' => 'ph:trash',
            ],
            'upstash_list_keys' => [
                'class' => UpstashListKeys::class,
                'type' => 'read',
                'name' => 'List Keys',
                'description' => 'List Redis keys matching a pattern.',
                'icon' => 'ph:list',
            ],
            'upstash_list_databases' => [
                'class' => UpstashListDatabases::class,
                'type' => 'read',
                'name' => 'List Databases',
                'description' => 'List all Redis databases in the Upstash account.',
                'icon' => 'ph:database',
            ],
            'upstash_get_database' => [
                'class' => UpstashGetDatabase::class,
                'type' => 'read',
                'name' => 'Get Database',
                'description' => 'Get details for a specific Upstash Redis database.',
                'icon' => 'ph:database',
            ],
            'upstash_get_current_user' => [
                'class' => UpstashGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get current team information from Upstash.',
                'icon' => 'ph:user',
            ],
        ];
    }

    /**
     * Path to the Lua documentation file (if any).
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/upstash.md';
    }

    /**
     * Credential fields for the integration.
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'redis_url', 'type' => 'url', 'label' => 'Redis REST URL', 'required' => true],
        ];
    }

    /**
     * Confirm this class represents an integration.
     */
    public function isIntegration(): bool
    {        return true;
    }

    /**
     * Instantiate a tool with an optionally scoped UpstashService.
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

            $service = new UpstashService(
                apiKey: $creds->get('upstash', 'api_key', '', $account),
                redisUrl: $creds->get('upstash', 'redis_url', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(UpstashService::class));
    }
}
