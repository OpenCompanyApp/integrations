<?php

namespace OpenCompany\Integrations\GoogleDrive;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\GoogleDrive\Tools\GoogleDriveListFiles;
use OpenCompany\Integrations\GoogleDrive\Tools\GoogleDriveGetFile;
use OpenCompany\Integrations\GoogleDrive\Tools\GoogleDriveCreateFile;
use OpenCompany\Integrations\GoogleDrive\Tools\GoogleDriveCreateFolder;
use OpenCompany\Integrations\GoogleDrive\Tools\GoogleDriveListChanges;
use OpenCompany\Integrations\GoogleDrive\Tools\GoogleDriveGetCurrentUser;

/**
 * Tool provider for the Google Drive integration.
 *
 * Implements ConfigurableIntegration for multi-account support and
 * exposes the full set of Google Drive tools.
 */
class GoogleDriveToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'google-drive';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'files, folders, changes, user',
            'description' => 'Cloud file storage',
            'icon' => 'ph:google-drive-logo',
            'logo' => 'simple-icons:googledrive',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Google Drive',
            'description' => 'Cloud storage and file management by Google',
            'icon' => 'ph:google-drive-logo',
            'logo' => 'simple-icons:googledrive',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.google.com/drive/api/v3/reference',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Google Drive OAuth access token',
                'hint' => 'Provide an OAuth 2.0 access token with Drive scope. Generate one via the Google OAuth playground or your app\'s auth flow.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://www.googleapis.com',
                'hint' => 'Google API base URL. Change only if using a proxy or custom endpoint.',
                'default' => 'https://www.googleapis.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://www.googleapis.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/drive/v3/about', [
                'fields' => 'user',
            ]);

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Google Drive API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error']['message'] ?? 'Unknown error';
                return ['success' => false, 'error' => $error];
            }

            $user = $json['user']['displayName'] ?? 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to Google Drive as {$user}.",
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
            'gdrive_list_files' => [
                'class' => GoogleDriveListFiles::class,
                'type' => 'read',
                'name' => 'List Files',
                'description' => 'List files and folders in Google Drive.',
                'icon' => 'ph:list',
            ],
            'gdrive_get_file' => [
                'class' => GoogleDriveGetFile::class,
                'type' => 'read',
                'name' => 'Get File',
                'description' => 'Get metadata for a specific file by ID.',
                'icon' => 'ph:file',
            ],
            'gdrive_create_file' => [
                'class' => GoogleDriveCreateFile::class,
                'type' => 'write',
                'name' => 'Create File',
                'description' => 'Create a new file in Google Drive.',
                'icon' => 'ph:file-plus',
            ],
            'gdrive_create_folder' => [
                'class' => GoogleDriveCreateFolder::class,
                'type' => 'write',
                'name' => 'Create Folder',
                'description' => 'Create a new folder in Google Drive.',
                'icon' => 'ph:folder-plus',
            ],
            'gdrive_list_changes' => [
                'class' => GoogleDriveListChanges::class,
                'type' => 'read',
                'name' => 'List Changes',
                'description' => 'List changes to files in Google Drive.',
                'icon' => 'ph:clock-counter-clockwise',
            ],
            'gdrive_get_current_user' => [
                'class' => GoogleDriveGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get info about the authenticated user and Drive storage.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/google-drive.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://www.googleapis.com'],
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

            $service = new GoogleDriveService(
                accessToken: $creds->get('google-drive', 'access_token', '', $account),
                baseUrl: $creds->get('google-drive', 'url', 'https://www.googleapis.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(GoogleDriveService::class));
    }
}
