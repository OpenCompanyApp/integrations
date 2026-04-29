<?php

namespace OpenCompany\Integrations\Strapi;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Strapi\Tools\StrapiCreateEntry;
use OpenCompany\Integrations\Strapi\Tools\StrapiDeleteEntry;
use OpenCompany\Integrations\Strapi\Tools\StrapiGetCurrentUser;
use OpenCompany\Integrations\Strapi\Tools\StrapiGetEntry;
use OpenCompany\Integrations\Strapi\Tools\StrapiListContentTypes;
use OpenCompany\Integrations\Strapi\Tools\StrapiListEntries;
use OpenCompany\Integrations\Strapi\Tools\StrapiUpdateEntry;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class StrapiToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'api_token',
            'legacy_auth_type' => 'api_token',
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
     * Get the application name identifier.
     */
    public function appName(): string
    {
        return 'strapi';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Strapi',
            'description' => 'Strapi headless CMS integration for Laravel — manage content types, entries, and users.',
            'icon' => 'ph:plug',
            'logo' => 'ph:plug',
        ];
    }

    /**
     * Canonical integration metadata used by settings and generated catalogs.
     *
     * @return array<string, mixed>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Strapi',
            'description' => 'Strapi headless CMS integration for Laravel — manage content types, entries, and users.',
            'icon' => 'ph:plug',
            'logo' => 'ph:plug',
            'category' => 'other',
            'badge' => 'verified',
        ];
    }
/**
     * Get the configuration schema for the integration.
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'Enter your Strapi API token',
                'hint' => 'Generate an API token in your Strapi admin panel under Settings → API Tokens',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'Instance URL',
                'placeholder' => 'https://localhost:1337',
                'hint' => 'The base URL of your Strapi instance (without <code>/api</code>)',
                'default' => 'https://localhost:1337',
            ],
        ];
    }

    /**
     * Test the connection to the Strapi instance.
     *
     * @param  array  $config  The configuration values.
     * @return array Result with success boolean and optional message or error.
     */
    public function testConnection(array $config): array
    {
        $apiToken = $config['api_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://localhost:1337', '/');

        if (empty($apiToken)) {
            return ['success' => false, 'error' => 'No API token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Strapi API at {$baseUrl}. Check the URL.",
                ];
            }

            if (! $response->successful()) {
                $error = $json['error'] ?? $response->body();

                return [
                    'success' => false,
                    'error' => is_string($error) ? $error : json_encode($error),
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Strapi at {$baseUrl}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the configuration.
     */
    public function validationRules(): array
    {
        return [
            'api_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Get the list of tools provided by this integration.
     */
    public function tools(): array
    {
        return [
            'strapi_list_entries' => [
                'class' => StrapiListEntries::class,
                'type' => 'read',
                'name' => 'List Entries',
                'description' => 'List entries for a content type with optional pagination, sorting, and population.',
                'icon' => 'ph:list',
            ],
            'strapi_get_entry' => [
                'class' => StrapiGetEntry::class,
                'type' => 'read',
                'name' => 'Get Entry',
                'description' => 'Get a single entry by content type and ID.',
                'icon' => 'ph:file-text',
            ],
            'strapi_create_entry' => [
                'class' => StrapiCreateEntry::class,
                'type' => 'write',
                'name' => 'Create Entry',
                'description' => 'Create a new entry for a content type.',
                'icon' => 'ph:plus',
            ],
            'strapi_update_entry' => [
                'class' => StrapiUpdateEntry::class,
                'type' => 'write',
                'name' => 'Update Entry',
                'description' => 'Update an existing entry by content type and ID.',
                'icon' => 'ph:pencil',
            ],
            'strapi_delete_entry' => [
                'class' => StrapiDeleteEntry::class,
                'type' => 'write',
                'name' => 'Delete Entry',
                'description' => 'Delete an entry by content type and ID.',
                'icon' => 'ph:trash',
            ],
            'strapi_list_content_types' => [
                'class' => StrapiListContentTypes::class,
                'type' => 'read',
                'name' => 'List Content Types',
                'description' => 'List all content types from the Strapi Content-Type Builder.',
                'icon' => 'ph:folders',
            ],
            'strapi_get_current_user' => [
                'class' => StrapiGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Strapi user.',
                'icon' => 'ph:user',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/strapi.md';
    }

    /**
     * Get the credential fields for the integration.
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Strapi URL', 'required' => false, 'default' => 'https://localhost:1337'],
        ];
    }

    /**
     * Indicate this is an integration provider.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance with the given context.
     *
     * @param  string  $class    The tool class to instantiate.
     * @param  array   $context  Context containing optional account information.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            $service = new StrapiService(
                apiToken: $creds->get('strapi', 'api_token', '', $account),
                baseUrl: $creds->get('strapi', 'url', 'https://localhost:1337', $account),
            );

            return new $class($service);
        }

        return new $class(app(StrapiService::class));
    }
}
