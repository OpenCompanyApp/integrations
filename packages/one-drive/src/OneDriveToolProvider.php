<?php

namespace OpenCompany\Integrations\OneDrive;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\OneDrive\Tools\OneDriveApiDelete;
use OpenCompany\Integrations\OneDrive\Tools\OneDriveApiGet;
use OpenCompany\Integrations\OneDrive\Tools\OneDriveApiPatch;
use OpenCompany\Integrations\OneDrive\Tools\OneDriveApiPost;
use OpenCompany\Integrations\OneDrive\Tools\OneDriveCopyItem;
use OpenCompany\Integrations\OneDrive\Tools\OneDriveCreateFolder;
use OpenCompany\Integrations\OneDrive\Tools\OneDriveCreateSharingLink;
use OpenCompany\Integrations\OneDrive\Tools\OneDriveDeleteItem;
use OpenCompany\Integrations\OneDrive\Tools\OneDriveDeletePermission;
use OpenCompany\Integrations\OneDrive\Tools\OneDriveDelta;
use OpenCompany\Integrations\OneDrive\Tools\OneDriveDownloadFile;
use OpenCompany\Integrations\OneDrive\Tools\OneDriveGetCurrentUser;
use OpenCompany\Integrations\OneDrive\Tools\OneDriveGetDrive;
use OpenCompany\Integrations\OneDrive\Tools\OneDriveGetFile;
use OpenCompany\Integrations\OneDrive\Tools\OneDriveListChildren;
use OpenCompany\Integrations\OneDrive\Tools\OneDriveListFiles;
use OpenCompany\Integrations\OneDrive\Tools\OneDriveListPermissions;
use OpenCompany\Integrations\OneDrive\Tools\OneDriveListShared;
use OpenCompany\Integrations\OneDrive\Tools\OneDriveListThumbnails;
use OpenCompany\Integrations\OneDrive\Tools\OneDriveSearch;
use OpenCompany\Integrations\OneDrive\Tools\OneDriveUpdateItem;
use OpenCompany\Integrations\OneDrive\Tools\OneDriveUploadFile;

/**
 * Tool catalog and setup metadata for the Microsoft OneDrive integration.
 *
 * Exposes Microsoft Graph DriveItem operations, sharing, delta sync, and
 * relative Graph API helpers for less-common endpoints.
 */
class OneDriveToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'one-drive';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Microsoft OneDrive',
            'description' => 'Cloud file storage',
            'icon' => 'ph:cloud-arrow-up',
            'logo' => 'simple-icons:microsoftonedrive',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Microsoft OneDrive',
            'description' => 'Cloud file storage and sharing via Microsoft Graph API',
            'icon' => 'ph:cloud-arrow-up',
            'logo' => 'simple-icons:microsoftonedrive',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://learn.microsoft.com/en-us/graph/api/resources/driveitem',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Microsoft Graph access token',
                'hint' => 'Provide a delegated access token with <code>Files.ReadWrite.All</code> and <code>User.Read</code> scopes',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'Graph API Base URL',
                'placeholder' => 'https://graph.microsoft.com/v1.0',
                'hint' => 'Microsoft Graph API endpoint. Use the default for global, or a national cloud endpoint if applicable.',
                'default' => 'https://graph.microsoft.com/v1.0',
            ],
        ];
    }

    /**
     * Verify that the configured token can read the signed-in user profile.
     *
     * @param  array<string, mixed>  $config  Setup form configuration.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://graph.microsoft.com/v1.0', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/me');

            if ($response->successful()) {
                $user = $response->json();
                $displayName = $user['displayName'] ?? 'Unknown';

                return [
                    'success' => true,
                    'message' => "Connected to Microsoft Graph API as {$displayName}.",
                ];
            }

            $error = $response->json('error.message') ?? $response->body();

            return [
                'success' => false,
                'error' => "Microsoft Graph API error ({$response->status()}): {$error}",
            ];
        } catch (\Throwable $e) {
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
            'onedrive_list_files' => [
                'class' => OneDriveListFiles::class,
                'type' => 'read',
                'name' => 'List Files',
                'description' => 'List files and folders in the root of the user\'s OneDrive.',
                'icon' => 'ph:folder-open',
            ],
            'onedrive_get_file' => [
                'class' => OneDriveGetFile::class,
                'type' => 'read',
                'name' => 'Get File',
                'description' => 'Get metadata for a specific file or folder by its ID.',
                'icon' => 'ph:file',
            ],
            'onedrive_get_drive' => [
                'class' => OneDriveGetDrive::class,
                'type' => 'read',
                'name' => 'Get Drive',
                'description' => 'Get metadata for the signed-in user\'s default OneDrive.',
                'icon' => 'ph:hard-drives',
            ],
            'onedrive_list_children' => [
                'class' => OneDriveListChildren::class,
                'type' => 'read',
                'name' => 'List Children',
                'description' => 'List files and folders under root or a specific folder item.',
                'icon' => 'ph:folders',
            ],
            'onedrive_create_folder' => [
                'class' => OneDriveCreateFolder::class,
                'type' => 'write',
                'name' => 'Create Folder',
                'description' => 'Create a folder in the root or under a parent folder item.',
                'icon' => 'ph:folder-plus',
            ],
            'onedrive_update_item' => [
                'class' => OneDriveUpdateItem::class,
                'type' => 'write',
                'name' => 'Update Item',
                'description' => 'Update, rename, or move a OneDrive file or folder.',
                'icon' => 'ph:pencil-simple',
            ],
            'onedrive_delete_item' => [
                'class' => OneDriveDeleteItem::class,
                'type' => 'write',
                'name' => 'Delete Item',
                'description' => 'Delete a OneDrive file or folder by ID.',
                'icon' => 'ph:trash',
            ],
            'onedrive_copy_item' => [
                'class' => OneDriveCopyItem::class,
                'type' => 'write',
                'name' => 'Copy Item',
                'description' => 'Copy a OneDrive file or folder asynchronously.',
                'icon' => 'ph:copy',
            ],
            'onedrive_upload_file' => [
                'class' => OneDriveUploadFile::class,
                'type' => 'write',
                'name' => 'Upload File',
                'description' => 'Upload a file to OneDrive by specifying a destination path.',
                'icon' => 'ph:upload-simple',
            ],
            'onedrive_download_file' => [
                'class' => OneDriveDownloadFile::class,
                'type' => 'read',
                'name' => 'Download File',
                'description' => 'Download a file\'s content by its drive item ID.',
                'icon' => 'ph:download-simple',
            ],
            'onedrive_list_shared' => [
                'class' => OneDriveListShared::class,
                'type' => 'read',
                'name' => 'List Shared',
                'description' => 'List files and folders shared with the current user.',
                'icon' => 'ph:users',
            ],
            'onedrive_search' => [
                'class' => OneDriveSearch::class,
                'type' => 'read',
                'name' => 'Search',
                'description' => 'Search files and folders in OneDrive.',
                'icon' => 'ph:magnifying-glass',
            ],
            'onedrive_delta' => [
                'class' => OneDriveDelta::class,
                'type' => 'read',
                'name' => 'Delta',
                'description' => 'Track changes in the signed-in user\'s drive.',
                'icon' => 'ph:arrows-clockwise',
            ],
            'onedrive_list_thumbnails' => [
                'class' => OneDriveListThumbnails::class,
                'type' => 'read',
                'name' => 'List Thumbnails',
                'description' => 'List thumbnail sets for a OneDrive item.',
                'icon' => 'ph:image',
            ],
            'onedrive_create_sharing_link' => [
                'class' => OneDriveCreateSharingLink::class,
                'type' => 'write',
                'name' => 'Create Sharing Link',
                'description' => 'Create or return a sharing link for a file or folder.',
                'icon' => 'ph:link',
            ],
            'onedrive_list_permissions' => [
                'class' => OneDriveListPermissions::class,
                'type' => 'read',
                'name' => 'List Permissions',
                'description' => 'List sharing permissions for a file or folder.',
                'icon' => 'ph:lock-key-open',
            ],
            'onedrive_delete_permission' => [
                'class' => OneDriveDeletePermission::class,
                'type' => 'write',
                'name' => 'Delete Permission',
                'description' => 'Delete a sharing permission from a file or folder.',
                'icon' => 'ph:lock-key',
            ],
            'onedrive_get_current_user' => [
                'class' => OneDriveGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the profile of the currently authenticated Microsoft user.',
                'icon' => 'ph:user',
            ],
            'onedrive_api_get' => [
                'class' => OneDriveApiGet::class,
                'type' => 'read',
                'name' => 'API GET',
                'description' => 'Call a relative Microsoft Graph GET endpoint.',
                'icon' => 'ph:brackets-curly',
            ],
            'onedrive_api_post' => [
                'class' => OneDriveApiPost::class,
                'type' => 'write',
                'name' => 'API POST',
                'description' => 'Call a relative Microsoft Graph POST endpoint.',
                'icon' => 'ph:brackets-curly',
            ],
            'onedrive_api_patch' => [
                'class' => OneDriveApiPatch::class,
                'type' => 'write',
                'name' => 'API PATCH',
                'description' => 'Call a relative Microsoft Graph PATCH endpoint.',
                'icon' => 'ph:brackets-curly',
            ],
            'onedrive_api_delete' => [
                'class' => OneDriveApiDelete::class,
                'type' => 'write',
                'name' => 'API DELETE',
                'description' => 'Call a relative Microsoft Graph DELETE endpoint.',
                'icon' => 'ph:brackets-curly',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/one-drive.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Graph API URL', 'required' => false, 'default' => 'https://graph.microsoft.com/v1.0'],
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
            $creds = app(CredentialResolver::class);
            $get = static function (string $key, mixed $default = '') use ($creds, $account): mixed {
                $value = $creds->get('one-drive', $key, null, $account);

                return $value !== null && $value !== ''
                    ? $value
                    : $creds->get('one_drive', $key, $default, $account);
            };

            $service = new OneDriveService(
                accessToken: $get('access_token'),
                baseUrl: $get('url', 'https://graph.microsoft.com/v1.0'),
            );

            return new $class($service);
        }

        return new $class(app(OneDriveService::class));
    }
}
