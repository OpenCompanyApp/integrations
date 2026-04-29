<?php

namespace OpenCompany\Integrations\Google;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\Integrations\Google\Services\GoogleDriveService;
use OpenCompany\Integrations\Google\Tools\GoogleDriveCopy;
use OpenCompany\Integrations\Google\Tools\GoogleDriveCreateFile;
use OpenCompany\Integrations\Google\Tools\GoogleDriveCreateFolder;
use OpenCompany\Integrations\Google\Tools\GoogleDriveDelete;
use OpenCompany\Integrations\Google\Tools\GoogleDriveMove;
use OpenCompany\Integrations\Google\Tools\GoogleDriveRename;
use OpenCompany\Integrations\Google\Tools\GoogleDriveGetFile;
use OpenCompany\Integrations\Google\Tools\GoogleDriveListPermissions;
use OpenCompany\Integrations\Google\Tools\GoogleDriveSearchFiles;
use OpenCompany\Integrations\Google\Tools\GoogleDriveShareFile;
use OpenCompany\Integrations\Google\Tools\GoogleDriveUnshareFile;
use OpenCompany\Integrations\Google\Tools\GoogleDriveStar;
use OpenCompany\Integrations\Google\Tools\GoogleDriveTrash;
use OpenCompany\Integrations\Google\Tools\GoogleDriveUnstar;
use OpenCompany\Integrations\Google\Tools\GoogleDriveUntrash;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class GoogleDriveToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'oauth2_authorization_code',
            'legacy_auth_type' => 'oauth',
            'credential_mode' => 'stored_token',
            'setup_flows' =>
            [
              0 => 'web_redirect',
              1 => 'local_redirect',
              2 => 'device_code',
            ],
            'requires_browser_for_setup' => true,
            'refreshable' => true,
            'token_keys' =>
            [
              0 => 'access_token',
              1 => 'refresh_token',
              2 => 'expires_at',
            ],
            'notes' =>
            [
              0 => 'Web hosts use the registered OAuth redirect callback.',
              1 => 'CLI hosts can support Google OAuth with a desktop loopback redirect; device-code setup is possible where scopes allow it.',
              2 => 'CLI runtime works with stored access and refresh tokens.',
            ],
          ],
          'host_availability' => [
            'web' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'web_redirect',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'local_redirect_or_device_code',
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
        return 'google_drive';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Google Drive',
            'description' => 'File storage and management',
            'icon' => 'ph:google-drive-logo',
            'logo' => 'simple-icons:googledrive',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Google Drive',
            'description' => 'File search, management, and sharing',
            'icon' => 'ph:google-drive-logo',
            'logo' => 'simple-icons:googledrive',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://console.cloud.google.com/apis/library/drive.googleapis.com',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'client_id',
                'type' => 'text',
                'label' => 'Client ID',
                'placeholder' => 'Your Google Cloud OAuth Client ID',
                'hint' => 'From <a href="https://console.cloud.google.com/apis/credentials" target="_blank">Google Cloud Console</a> &rarr; Credentials &rarr; OAuth 2.0 Client IDs. Shared across all Google integrations &mdash; only needs to be entered once.',
                'required' => true,
            ],
            [
                'key' => 'client_secret',
                'type' => 'secret',
                'label' => 'Client Secret',
                'placeholder' => 'Your Google Cloud OAuth Client Secret',
                'required' => true,
            ],
            [
                'key' => 'access_token',
                'type' => 'oauth_connect',
                'label' => 'Google Account',
                'authorize_url' => '/api/integrations/google/oauth/authorize?service=google_drive',
                'redirect_uri' => '/api/integrations/google/oauth/callback',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $connectedEmail = $config['connected_email'] ?? null;

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'Not connected. Click "Connect with Google Drive" to authorize.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
            ])->timeout(10)->get('https://www.googleapis.com/drive/v3/about', [
                'fields' => 'user(displayName,emailAddress),storageQuota(usage,limit)',
            ]);

            if ($response->successful()) {
                $data = $response->json() ?? [];
                $email = $data['user']['emailAddress'] ?? $connectedEmail ?? 'unknown';
                $usage = (int) ($data['storageQuota']['usage'] ?? 0);
                $limit = (int) ($data['storageQuota']['limit'] ?? 0);

                $usageFormatted = GoogleDriveService::formatSize($usage);
                $message = "Connected as {$email}. {$usageFormatted} used.";
                if ($limit > 0) {
                    $limitFormatted = GoogleDriveService::formatSize($limit);
                    $message = "Connected as {$email}. {$usageFormatted} of {$limitFormatted} used.";
                }

                return ['success' => true, 'message' => $message];
            }

            $error = $response->json('error.message') ?? $response->body();

            return [
                'success' => false,
                'error' => 'Drive API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'oauth', 'label' => 'Google Account', 'required' => true],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /** @param  array<string, mixed>  $context */
    public function createTool(string $class, array $context = []): Tool
    {
        $service = app(GoogleDriveService::class);

        return new $class($service);
    }
}
