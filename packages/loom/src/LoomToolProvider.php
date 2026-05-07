<?php

namespace OpenCompany\Integrations\Loom;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Loom\Tools\LoomCreateVideo;
use OpenCompany\Integrations\Loom\Tools\LoomDeleteVideo;
use OpenCompany\Integrations\Loom\Tools\LoomGetCurrentUser;
use OpenCompany\Integrations\Loom\Tools\LoomGetFolder;
use OpenCompany\Integrations\Loom\Tools\LoomGetVideo;
use OpenCompany\Integrations\Loom\Tools\LoomListFolders;
use OpenCompany\Integrations\Loom\Tools\LoomListVideos;
use OpenCompany\Integrations\Loom\Tools\LoomListWorkspaces;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class LoomToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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




/**
     * Get the application identifier.
     */
    public function appName(): string
    {
        return 'loom';
    }

/**
     * Get short metadata for UI display.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Loom',
            'description' => 'Video platform',
            'icon' => 'ph:video-camera',
            'logo' => 'simple-icons:loom',
        ];
    }

/**
     * Get full integration metadata for marketplace/settings display.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Loom',
            'description' => 'Video messaging and screen recording platform',
            'icon' => 'ph:video-camera',
            'logo' => 'simple-icons:loom',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://developer.loom.com/docs/api-reference',
        ];
    }/**
     * Get the configuration schema for the Loom integration.
     *
     * Defines the fields required to connect to the Loom API,
     * including the OAuth access token and optional base URL override.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Loom access token',
                'hint' => 'Generate a personal access token in your Loom account settings under "Integrations"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.loom.com',
                'hint' => 'The default Loom API URL. Change only if using a proxy or custom endpoint.',
                'default' => 'https://api.loom.com',
            ],
        ];
    }

    /**
     * Test the connection to the Loom API using the provided configuration.
     *
     * @param  array<string, mixed>  $config  Configuration values to test.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.loom.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/v1/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Loom API at {$baseUrl}. Check the URL.",
                ];
            }

            $userName = $json['name'] ?? 'Unknown user';

            return [
                'success' => true,
                'message' => "Connected to Loom API as {$userName}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the Loom configuration fields.
     *
     * @return array<string, string|array<int, string>>
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Get the list of tools provided by this integration.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'loom_list_videos' => [
                'class' => LoomListVideos::class,
                'type' => 'read',
                'name' => 'List Videos',
                'description' => 'List Loom videos with pagination.',
                'icon' => 'ph:video-camera',
            ],
            'loom_get_video' => [
                'class' => LoomGetVideo::class,
                'type' => 'read',
                'name' => 'Get Video',
                'description' => 'Get details for a specific Loom video.',
                'icon' => 'ph:video-camera',
            ],
            'loom_create_video' => [
                'class' => LoomCreateVideo::class,
                'type' => 'write',
                'name' => 'Create Video',
                'description' => 'Create a new Loom video placeholder.',
                'icon' => 'ph:plus-circle',
            ],
            'loom_delete_video' => [
                'class' => LoomDeleteVideo::class,
                'type' => 'write',
                'name' => 'Delete Video',
                'description' => 'Delete a Loom video.',
                'icon' => 'ph:trash',
            ],
            'loom_list_workspaces' => [
                'class' => LoomListWorkspaces::class,
                'type' => 'read',
                'name' => 'List Workspaces',
                'description' => 'List all accessible Loom workspaces.',
                'icon' => 'ph:buildings',
            ],
            'loom_list_folders' => [
                'class' => LoomListFolders::class,
                'type' => 'read',
                'name' => 'List Folders',
                'description' => 'List Loom folders with pagination.',
                'icon' => 'ph:folder',
            ],
            'loom_get_folder' => [
                'class' => LoomGetFolder::class,
                'type' => 'read',
                'name' => 'Get Folder',
                'description' => 'Get details for a specific Loom folder.',
                'icon' => 'ph:folder-open',
            ],
            'loom_get_current_user' => [
                'class' => LoomGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s profile.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    /**
     * Get the path to the Lua API documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/loom.md';
    }

    /**
     * Get the credential fields for authentication.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.loom.com'],
        ];
    }

    /**
     * Confirm this is an integration provider.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally for a specific account.
     *
     * Supports multi-account by resolving account-specific credentials
     * when an account context is provided.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Optional context including 'account' for multi-account support.
     */
    public function createTool(string $class, array $context = []): Tool
    {        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new LoomService(
                accessToken: $creds->get('loom', 'access_token', '', $account),
                baseUrl: $creds->get('loom', 'url', 'https://api.loom.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(LoomService::class));
    }
}
