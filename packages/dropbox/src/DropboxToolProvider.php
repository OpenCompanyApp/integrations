<?php

namespace OpenCompany\Integrations\Dropbox;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Dropbox\Tools\DropboxCopy;
use OpenCompany\Integrations\Dropbox\Tools\DropboxCreateFolder;
use OpenCompany\Integrations\Dropbox\Tools\DropboxCreateSharedLink;
use OpenCompany\Integrations\Dropbox\Tools\DropboxDelete;
use OpenCompany\Integrations\Dropbox\Tools\DropboxDownloadFile;
use OpenCompany\Integrations\Dropbox\Tools\DropboxGetCurrentAccount;
use OpenCompany\Integrations\Dropbox\Tools\DropboxGetMetadata;
use OpenCompany\Integrations\Dropbox\Tools\DropboxGetTemporaryLink;
use OpenCompany\Integrations\Dropbox\Tools\DropboxListFolder;
use OpenCompany\Integrations\Dropbox\Tools\DropboxListFolderContinue;
use OpenCompany\Integrations\Dropbox\Tools\DropboxListRevisions;
use OpenCompany\Integrations\Dropbox\Tools\DropboxListSharedLinks;
use OpenCompany\Integrations\Dropbox\Tools\DropboxMove;
use OpenCompany\Integrations\Dropbox\Tools\DropboxRestore;
use OpenCompany\Integrations\Dropbox\Tools\DropboxSearchContinue;
use OpenCompany\Integrations\Dropbox\Tools\DropboxSearchFiles;
use OpenCompany\Integrations\Dropbox\Tools\DropboxUploadFile;

/**
 * Registers the Dropbox integration and its tools with the integration platform.
 *
 * Provides file, folder, search, sharing, revision, and account management
 * tools via the Dropbox API v2.
 */
class DropboxToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'dropbox';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'files, folders, sharing, search',
            'description' => 'Dropbox integration for cloud storage',
            'icon' => 'mdi:dropbox',
            'logo' => 'mdi:dropbox',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Dropbox',
            'description' => 'Manage files, folders, sharing, and search on Dropbox.',
            'icon' => 'mdi:dropbox',
            'logo' => 'mdi:dropbox',
            'category' => 'storage',
            'docs_url' => 'https://www.dropbox.com/developers/documentation/http/documentation',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'sl.B...',
                'hint' => 'Generate an OAuth2 access token in the <a href="https://www.dropbox.com/developers/apps" target="_blank">Dropbox App Console</a>. Use the generated access token or implement the OAuth2 flow.',
                'required' => true,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => "Bearer {$accessToken}",
                'Content-Type' => 'application/json',
            ])->timeout(10)->post('https://api.dropboxapi.com/2/users/get_current_account');

            if ($response->successful()) {
                $data = $response->json();
                $name = $data['name']['display_name'] ?? 'unknown';
                $email = $data['email'] ?? 'unknown';

                return [
                    'success' => true,
                    'message' => "Connected to Dropbox as {$name} ({$email}).",
                ];
            }

            $error = $response->json('error_summary') ?? $response->body();

            return [
                'success' => false,
                'error' => 'Dropbox API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string|array<int, string>> */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            'dropbox_list_folder' => [
                'class' => DropboxListFolder::class,
                'type' => 'read',
                'name' => 'List Folder',
                'description' => 'List files and folders in a Dropbox directory.',
                'icon' => 'mdi:folder-open-outline',
            ],
            'dropbox_list_folder_continue' => [
                'class' => DropboxListFolderContinue::class,
                'type' => 'read',
                'name' => 'List Folder Continue',
                'description' => 'Continue listing files using a pagination cursor.',
                'icon' => 'mdi:folder-open-outline',
            ],
            'dropbox_upload_file' => [
                'class' => DropboxUploadFile::class,
                'type' => 'write',
                'name' => 'Upload File',
                'description' => 'Upload a file to Dropbox.',
                'icon' => 'mdi:cloud-upload-outline',
            ],
            'dropbox_download_file' => [
                'class' => DropboxDownloadFile::class,
                'type' => 'read',
                'name' => 'Download File',
                'description' => 'Download a file from Dropbox.',
                'icon' => 'mdi:cloud-download-outline',
            ],
            'dropbox_create_folder' => [
                'class' => DropboxCreateFolder::class,
                'type' => 'write',
                'name' => 'Create Folder',
                'description' => 'Create a new folder in Dropbox.',
                'icon' => 'mdi:folder-plus-outline',
            ],
            'dropbox_delete' => [
                'class' => DropboxDelete::class,
                'type' => 'write',
                'name' => 'Delete',
                'description' => 'Delete a file or folder from Dropbox.',
                'icon' => 'mdi:delete-outline',
            ],
            'dropbox_move' => [
                'class' => DropboxMove::class,
                'type' => 'write',
                'name' => 'Move',
                'description' => 'Move a file or folder to a new location.',
                'icon' => 'mdi:file-move-outline',
            ],
            'dropbox_copy' => [
                'class' => DropboxCopy::class,
                'type' => 'write',
                'name' => 'Copy',
                'description' => 'Copy a file or folder to a new location.',
                'icon' => 'mdi:content-copy',
            ],
            'dropbox_search_files' => [
                'class' => DropboxSearchFiles::class,
                'type' => 'read',
                'name' => 'Search Files',
                'description' => 'Search for files and folders in Dropbox.',
                'icon' => 'mdi:magnify',
            ],
            'dropbox_search_continue' => [
                'class' => DropboxSearchContinue::class,
                'type' => 'read',
                'name' => 'Search Continue',
                'description' => 'Continue a search using a pagination cursor.',
                'icon' => 'mdi:magnify',
            ],
            'dropbox_create_shared_link' => [
                'class' => DropboxCreateSharedLink::class,
                'type' => 'write',
                'name' => 'Create Shared Link',
                'description' => 'Create a shared link for a file or folder.',
                'icon' => 'mdi:link-variant',
            ],
            'dropbox_list_shared_links' => [
                'class' => DropboxListSharedLinks::class,
                'type' => 'read',
                'name' => 'List Shared Links',
                'description' => 'List shared links for a file or folder.',
                'icon' => 'mdi:link-variant',
            ],
            'dropbox_get_temporary_link' => [
                'class' => DropboxGetTemporaryLink::class,
                'type' => 'read',
                'name' => 'Get Temporary Link',
                'description' => 'Get a temporary link to stream a file.',
                'icon' => 'mdi:link-variant',
            ],
            'dropbox_list_revisions' => [
                'class' => DropboxListRevisions::class,
                'type' => 'read',
                'name' => 'List Revisions',
                'description' => 'List revisions of a file.',
                'icon' => 'mdi:history',
            ],
            'dropbox_restore' => [
                'class' => DropboxRestore::class,
                'type' => 'write',
                'name' => 'Restore',
                'description' => 'Restore a file to a specific revision.',
                'icon' => 'mdi:restore',
            ],
            'dropbox_get_metadata' => [
                'class' => DropboxGetMetadata::class,
                'type' => 'read',
                'name' => 'Get Metadata',
                'description' => 'Get metadata for a file or folder.',
                'icon' => 'mdi:information-outline',
            ],
            'dropbox_get_current_account' => [
                'class' => DropboxGetCurrentAccount::class,
                'type' => 'read',
                'name' => 'Get Current Account',
                'description' => 'Get the authenticated account info.',
                'icon' => 'mdi:account-outline',
            ],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function luaDocsPath(): ?string
    {
        return null;
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
        ];
    }

    /** @param  array<string, mixed>  $context */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new DropboxService(
                accessToken: $creds->get('dropbox', 'access_token', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(DropboxService::class));
    }
}
