<?php

namespace OpenCompany\Integrations\Google;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\Integrations\Google\Services\GoogleDocsService;
use OpenCompany\Integrations\Google\Tools\GoogleDocsAddBullets;
use OpenCompany\Integrations\Google\Tools\GoogleDocsCreate;
use OpenCompany\Integrations\Google\Tools\GoogleDocsDeleteRange;
use OpenCompany\Integrations\Google\Tools\GoogleDocsFormatText;
use OpenCompany\Integrations\Google\Tools\GoogleDocsGet;
use OpenCompany\Integrations\Google\Tools\GoogleDocsGetStructure;
use OpenCompany\Integrations\Google\Tools\GoogleDocsInsertImage;
use OpenCompany\Integrations\Google\Tools\GoogleDocsInsertPageBreak;
use OpenCompany\Integrations\Google\Tools\GoogleDocsInsertTable;
use OpenCompany\Integrations\Google\Tools\GoogleDocsInsertText;
use OpenCompany\Integrations\Google\Tools\GoogleDocsRemoveBullets;
use OpenCompany\Integrations\Google\Tools\GoogleDocsReplaceAll;
use OpenCompany\Integrations\Google\Tools\GoogleDocsSearchText;
use OpenCompany\Integrations\Google\Tools\GoogleDocsSetHeading;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class GoogleDocsToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'google_docs';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Google Docs',
            'description' => 'Create, read, and edit Google Docs',
            'icon' => 'ph:file-doc',
            'logo' => 'simple-icons:googledocs',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Google Docs',
            'description' => 'Create, read, and edit documents with formatting, tables, and images',
            'icon' => 'ph:file-doc',
            'logo' => 'simple-icons:googledocs',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://console.cloud.google.com/apis/library/docs.googleapis.com',
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
                'authorize_url' => '/api/integrations/google/oauth/authorize?service=google_docs',
                'redirect_uri' => '/api/integrations/google/oauth/callback',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $connectedEmail = $config['connected_email'] ?? null;

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'Not connected. Click "Connect with Google Docs" to authorize.'];
        }

        try {
            // Verify the token works by fetching user info
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
            ])->timeout(10)->get('https://www.googleapis.com/oauth2/v2/userinfo');

            if ($response->successful()) {
                $email = $response->json('email') ?? $connectedEmail;
                $emailInfo = $email ? " ({$email})" : '';

                return [
                    'success' => true,
                    'message' => "Google Docs connected{$emailInfo}.",
                ];
            }

            $error = $response->json('error.message') ?? $response->body();

            return [
                'success' => false,
                'error' => 'Google API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
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
        $service = app(GoogleDocsService::class);

        return new $class($service);
    }
}
