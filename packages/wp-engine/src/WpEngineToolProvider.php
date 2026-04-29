<?php

namespace OpenCompany\Integrations\WpEngine;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\WpEngine\Tools\WpEngineListSites;
use OpenCompany\Integrations\WpEngine\Tools\WpEngineGetSite;
use OpenCompany\Integrations\WpEngine\Tools\WpEngineListInstalls;
use OpenCompany\Integrations\WpEngine\Tools\WpEngineGetInstall;
use OpenCompany\Integrations\WpEngine\Tools\WpEngineListDomains;
use OpenCompany\Integrations\WpEngine\Tools\WpEngineListUsers;
use OpenCompany\Integrations\WpEngine\Tools\WpEngineGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class WpEngineToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'bearer_token',
            'legacy_auth_type' => 'oauth',
            'credential_mode' => 'stored_token',
            'setup_flows' =>
            [
              0 => 'manual_token',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
              0 => 'access_token',
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
              'setup_mode' => 'manual_token',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_token',
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

    public function appName(): string
    {
        return 'wp_engine';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'WP Engine',
            'description' => 'WordPress hosting management',
            'icon' => 'ph:wordpress-logo',
            'logo' => 'simple-icons:wpengine',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'WP Engine',
            'description' => 'WordPress hosting platform for sites, installs, and domains',
            'icon' => 'ph:wordpress-logo',
            'logo' => 'simple-icons:wpengine',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://wpengineapi.com/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'Enter your WP Engine API token',
                'hint' => 'Generate an API token from your WP Engine User Portal under "API Tokens"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.wpengineapi.com/v1',
                'hint' => 'Use <code>https://api.wpengineapi.com/v1</code> for the default API, or a custom endpoint',
                'default' => 'https://api.wpengineapi.com/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.wpengineapi.com/v1', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No API token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/user');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach WP Engine API at {$baseUrl}. Check the URL.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to WP Engine API at {$baseUrl}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'wp_engine_list_sites' => [
                'class' => WpEngineListSites::class,
                'type' => 'read',
                'name' => 'List Sites',
                'description' => 'List WP Engine sites with optional pagination.',
                'icon' => 'ph:globe',
            ],
            'wp_engine_get_site' => [
                'class' => WpEngineGetSite::class,
                'type' => 'read',
                'name' => 'Get Site',
                'description' => 'Get details for a specific WP Engine site.',
                'icon' => 'ph:globe',
            ],
            'wp_engine_list_installs' => [
                'class' => WpEngineListInstalls::class,
                'type' => 'read',
                'name' => 'List Installs',
                'description' => 'List WP Engine installs with optional pagination.',
                'icon' => 'ph:wordpress-logo',
            ],
            'wp_engine_get_install' => [
                'class' => WpEngineGetInstall::class,
                'type' => 'read',
                'name' => 'Get Install',
                'description' => 'Get details for a specific WP Engine install.',
                'icon' => 'ph:wordpress-logo',
            ],
            'wp_engine_list_domains' => [
                'class' => WpEngineListDomains::class,
                'type' => 'read',
                'name' => 'List Domains',
                'description' => 'List domains across WP Engine installs.',
                'icon' => 'ph:link',
            ],
            'wp_engine_list_users' => [
                'class' => WpEngineListUsers::class,
                'type' => 'read',
                'name' => 'List Users',
                'description' => 'List WP Engine users with optional pagination.',
                'icon' => 'ph:users',
            ],
            'wp_engine_get_current_user' => [
                'class' => WpEngineGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user profile.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/wp-engine.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.wpengineapi.com/v1'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new WpEngineService(
                accessToken: $creds->get('wp_engine', 'access_token', '', $account),
                baseUrl: $creds->get('wp_engine', 'url', 'https://api.wpengineapi.com/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(WpEngineService::class));
    }
}
