<?php

namespace OpenCompany\Integrations\Podio;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Podio\Tools\PodioListSpaces;
use OpenCompany\Integrations\Podio\Tools\PodioGetSpace;
use OpenCompany\Integrations\Podio\Tools\PodioListApps;
use OpenCompany\Integrations\Podio\Tools\PodioGetApp;
use OpenCompany\Integrations\Podio\Tools\PodioListItems;
use OpenCompany\Integrations\Podio\Tools\PodioGetItem;
use OpenCompany\Integrations\Podio\Tools\PodioGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class PodioToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'oauth2_manual_token',
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
              0 => 'Token acquisition may happen outside this package, but the host only needs to store the resulting token.',
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
        return 'podio';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Podio',
            'description' => 'Project management & collaboration',
            'icon' => 'ph:folders',
            'logo' => 'simple-icons:podio',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Podio',
            'description' => 'Collaborative work management platform for teams',
            'icon' => 'ph:folders',
            'logo' => 'simple-icons:podio',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.podio.com',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Podio OAuth2 access token',
                'hint' => 'Generate an OAuth2 access token in your Podio developer settings at <a href="https://developers.podio.com/authentication" target="_blank">developers.podio.com</a>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.podio.com',
                'hint' => 'The Podio API base URL. Use <code>https://api.podio.com</code> unless you have a custom endpoint.',
                'default' => 'https://api.podio.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.podio.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/user/status');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Podio API at {$baseUrl}. Check the URL.",
                ];
            }

            $userName = $json['profile']['name'] ?? 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to Podio API as {$userName}.",
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
            'podio_list_spaces' => [
                'class' => PodioListSpaces::class,
                'type' => 'read',
                'name' => 'List Spaces',
                'description' => 'List all workspaces in a Podio organization.',
                'icon' => 'ph:folders',
            ],
            'podio_get_space' => [
                'class' => PodioGetSpace::class,
                'type' => 'read',
                'name' => 'Get Space',
                'description' => 'Get details of a specific Podio workspace.',
                'icon' => 'ph:folder-open',
            ],
            'podio_list_apps' => [
                'class' => PodioListApps::class,
                'type' => 'read',
                'name' => 'List Apps',
                'description' => 'List all apps in a Podio workspace.',
                'icon' => 'ph:squares-four',
            ],
            'podio_get_app' => [
                'class' => PodioGetApp::class,
                'type' => 'read',
                'name' => 'Get App',
                'description' => 'Get details of a specific Podio app.',
                'icon' => 'ph:square',
            ],
            'podio_list_items' => [
                'class' => PodioListItems::class,
                'type' => 'read',
                'name' => 'List Items',
                'description' => 'List and filter items in a Podio app.',
                'icon' => 'ph:list-dashes',
            ],
            'podio_get_item' => [
                'class' => PodioGetItem::class,
                'type' => 'read',
                'name' => 'Get Item',
                'description' => 'Get details of a specific Podio item.',
                'icon' => 'ph:article',
            ],
            'podio_get_current_user' => [
                'class' => PodioGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user\'s status.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/podio.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.podio.com'],
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

            $service = new PodioService(
                accessToken: $creds->get('podio', 'access_token', '', $account),
                baseUrl: $creds->get('podio', 'url', 'https://api.podio.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(PodioService::class));
    }
}
