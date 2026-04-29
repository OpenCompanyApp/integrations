<?php

namespace OpenCompany\Integrations\Box;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Box\Tools\BoxListFiles;
use OpenCompany\Integrations\Box\Tools\BoxGetFile;
use OpenCompany\Integrations\Box\Tools\BoxUploadFile;
use OpenCompany\Integrations\Box\Tools\BoxDownloadFile;
use OpenCompany\Integrations\Box\Tools\BoxDeleteFile;
use OpenCompany\Integrations\Box\Tools\BoxCreateFolder;
use OpenCompany\Integrations\Box\Tools\BoxGetFolder;
use OpenCompany\Integrations\Box\Tools\BoxShareFile;
use OpenCompany\Integrations\Box\Tools\BoxSearch;
use OpenCompany\Integrations\Box\Tools\BoxGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class BoxToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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

    /**
     * Get the integration app name.
     */
    public function appName(): string
    {
        return 'box';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Box',
            'description' => 'Box integration for Laravel — manage files, folders, sharing, and search via the Box…',
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
            'name' => 'Box',
            'description' => 'Box integration for Laravel — manage files, folders, sharing, and search via the Box API.',
            'icon' => 'ph:plug',
            'logo' => 'ph:plug',
            'category' => 'other',
            'badge' => 'verified',
        ];
    }
/**
     * Get the configuration schema for the integration.
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
                'placeholder' => 'Enter your Box access token',
                'hint' => 'Generate a developer token in the <a href="https://app.box.com/developers/console" target="_blank">Box Developer Console</a>, or use an OAuth2 token',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.box.com/2.0',
                'hint' => 'Use the default Box API URL, or a custom API gateway URL',
                'default' => 'https://api.box.com/2.0',
            ],
        ];
    }

    /**
     * Test the connection to Box using the provided config.
     *
     * @param  array<string, mixed>  $config
     * @return array<string, mixed>
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.box.com/2.0', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
            ])->timeout(10)->get($baseUrl . '/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Box API at {$baseUrl}. Check the URL.",
                ];
            }

            $userName = ($json['name'] ?? 'Unknown') . ' (' . ($json['login'] ?? '') . ')';

            return [
                'success' => true,
                'message' => "Connected to Box as {$userName}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the configuration.
     *
     * @return array<string, mixed>
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Get all available tools for this integration.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        return [
            'box_list_files' => [
                'class' => BoxListFiles::class,
                'type' => 'read',
                'name' => 'List Files',
                'description' => 'List files and folders in a Box folder.',
                'icon' => 'ph:list-bullets',
            ],
            'box_get_file' => [
                'class' => BoxGetFile::class,
                'type' => 'read',
                'name' => 'Get File',
                'description' => 'Get metadata for a Box file.',
                'icon' => 'ph:file',
            ],
            'box_upload_file' => [
                'class' => BoxUploadFile::class,
                'type' => 'write',
                'name' => 'Upload File',
                'description' => 'Upload a file to Box.',
                'icon' => 'ph:upload-simple',
            ],
            'box_download_file' => [
                'class' => BoxDownloadFile::class,
                'type' => 'read',
                'name' => 'Download File',
                'description' => 'Download a file from Box.',
                'icon' => 'ph:download-simple',
            ],
            'box_delete_file' => [
                'class' => BoxDeleteFile::class,
                'type' => 'write',
                'name' => 'Delete File',
                'description' => 'Delete a file from Box.',
                'icon' => 'ph:trash',
            ],
            'box_create_folder' => [
                'class' => BoxCreateFolder::class,
                'type' => 'write',
                'name' => 'Create Folder',
                'description' => 'Create a new folder in Box.',
                'icon' => 'ph:folder-plus',
            ],
            'box_get_folder' => [
                'class' => BoxGetFolder::class,
                'type' => 'read',
                'name' => 'Get Folder',
                'description' => 'Get metadata for a Box folder.',
                'icon' => 'ph:folder',
            ],
            'box_share_file' => [
                'class' => BoxShareFile::class,
                'type' => 'write',
                'name' => 'Share File',
                'description' => 'Create a shared link for a Box file.',
                'icon' => 'ph:share',
            ],
            'box_search' => [
                'class' => BoxSearch::class,
                'type' => 'read',
                'name' => 'Search',
                'description' => 'Search for files and folders in Box.',
                'icon' => 'ph:magnifying-glass',
            ],
            'box_get_current_user' => [
                'class' => BoxGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Box user.',
                'icon' => 'ph:user',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/box.md';
    }

    /**
     * Get the credential fields for the integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.box.com/2.0'],
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
     * Create a tool instance, optionally with account-specific credentials.
     *
     * @param  class-string<Tool>  $class
     * @param  array<string, mixed>  $context
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new BoxService(
                accessToken: $creds->get('box', 'access_token', '', $account),
                baseUrl: $creds->get('box', 'url', 'https://api.box.com/2.0', $account),
            );

            return new $class($service);
        }

        return new $class(app(BoxService::class));
    }
}
