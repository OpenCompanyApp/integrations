<?php

namespace OpenCompany\Integrations\Droplr;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Droplr\Tools\DroplrListDrops;
use OpenCompany\Integrations\Droplr\Tools\DroplrGetDrop;
use OpenCompany\Integrations\Droplr\Tools\DroplrCreateDrop;
use OpenCompany\Integrations\Droplr\Tools\DroplrDeleteDrop;
use OpenCompany\Integrations\Droplr\Tools\DroplrListBoards;
use OpenCompany\Integrations\Droplr\Tools\DroplrGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class DroplrToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'droplr';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'drops, links, boards',
            'description' => 'Link shortening & file sharing',
            'icon' => 'ph:link',
            'logo' => 'simple-icons:droplr',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Droplr',
            'description' => 'Link shortening, file sharing, and screenshot tool',
            'icon' => 'ph:link',
            'logo' => 'simple-icons:droplr',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://droplr.com/docs/api',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Droplr access token',
                'hint' => 'Generate an access token in your Droplr account settings under "Integrations"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.droplr.com',
                'hint' => 'Use <code>https://api.droplr.com</code> for the default API, or your custom endpoint',
                'default' => 'https://api.droplr.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.droplr.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/v2/user');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Droplr API at {$baseUrl}. Check the URL.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Droplr API as {$json['email']}.",
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
            'droplr_list_drops' => [
                'class' => DroplrListDrops::class,
                'type' => 'read',
                'name' => 'List Drops',
                'description' => 'List drops (short links, files, images, notes).',
                'icon' => 'ph:list',
            ],
            'droplr_get_drop' => [
                'class' => DroplrGetDrop::class,
                'type' => 'read',
                'name' => 'Get Drop',
                'description' => 'Get details of a specific drop.',
                'icon' => 'ph:link',
            ],
            'droplr_create_drop' => [
                'class' => DroplrCreateDrop::class,
                'type' => 'write',
                'name' => 'Create Drop',
                'description' => 'Create a new short link (drop).',
                'icon' => 'ph:plus',
            ],
            'droplr_delete_drop' => [
                'class' => DroplrDeleteDrop::class,
                'type' => 'write',
                'name' => 'Delete Drop',
                'description' => 'Delete a drop.',
                'icon' => 'ph:trash',
            ],
            'droplr_list_boards' => [
                'class' => DroplrListBoards::class,
                'type' => 'read',
                'name' => 'List Boards',
                'description' => 'List boards (collections of drops).',
                'icon' => 'ph:folder',
            ],
            'droplr_get_current_user' => [
                'class' => DroplrGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s profile.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/droplr.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.droplr.com'],
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

            $service = new DroplrService(
                accessToken: $creds->get('droplr', 'access_token', '', $account),
                baseUrl: $creds->get('droplr', 'url', 'https://api.droplr.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(DroplrService::class));
    }
}
