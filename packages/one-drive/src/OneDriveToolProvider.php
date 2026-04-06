<?php

namespace OpenCompany\Integrations\OneDrive;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\OneDrive\Tools\OneDriveListFiles;
use OpenCompany\Integrations\OneDrive\Tools\OneDriveGetFile;
use OpenCompany\Integrations\OneDrive\Tools\OneDriveUploadFile;
use OpenCompany\Integrations\OneDrive\Tools\OneDriveDownloadFile;
use OpenCompany\Integrations\OneDrive\Tools\OneDriveListShared;
use OpenCompany\Integrations\OneDrive\Tools\OneDriveGetCurrentUser;

class OneDriveToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'one_drive';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'files, upload, download, shared',
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
            'category' => 'storage',
            'badge' => 'verified',
            'docs_url' => 'https://learn.microsoft.com/en-us/onedrive/developer/rest-api/',
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
            ])->timeout(10)->get($baseUrl . '/users/me');

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
            'onedrive_get_current_user' => [
                'class' => OneDriveGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the profile of the currently authenticated Microsoft user.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/one-drive.md';
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
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new OneDriveService(
                accessToken: $creds->get('one_drive', 'access_token', '', $account),
                baseUrl: $creds->get('one_drive', 'url', 'https://graph.microsoft.com/v1.0', $account),
            );

            return new $class($service);
        }

        return new $class(app(OneDriveService::class));
    }
}
