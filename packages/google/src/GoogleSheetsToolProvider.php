<?php

namespace OpenCompany\Integrations\Google;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\Integrations\Google\Services\GoogleSheetsService;
use OpenCompany\Integrations\Google\Tools\GoogleSheetsAddFilter;
use OpenCompany\Integrations\Google\Tools\GoogleSheetsAddSheet;
use OpenCompany\Integrations\Google\Tools\GoogleSheetsAppend;
use OpenCompany\Integrations\Google\Tools\GoogleSheetsBatchRead;
use OpenCompany\Integrations\Google\Tools\GoogleSheetsBatchWrite;
use OpenCompany\Integrations\Google\Tools\GoogleSheetsClear;
use OpenCompany\Integrations\Google\Tools\GoogleSheetsCreate;
use OpenCompany\Integrations\Google\Tools\GoogleSheetsDeleteColumns;
use OpenCompany\Integrations\Google\Tools\GoogleSheetsDeleteRows;
use OpenCompany\Integrations\Google\Tools\GoogleSheetsDeleteSheet;
use OpenCompany\Integrations\Google\Tools\GoogleSheetsDuplicateSheet;
use OpenCompany\Integrations\Google\Tools\GoogleSheetsFind;
use OpenCompany\Integrations\Google\Tools\GoogleSheetsGetMetadata;
use OpenCompany\Integrations\Google\Tools\GoogleSheetsInsertColumns;
use OpenCompany\Integrations\Google\Tools\GoogleSheetsInsertRows;
use OpenCompany\Integrations\Google\Tools\GoogleSheetsReadRange;
use OpenCompany\Integrations\Google\Tools\GoogleSheetsRemoveFilter;
use OpenCompany\Integrations\Google\Tools\GoogleSheetsRenameSheet;
use OpenCompany\Integrations\Google\Tools\GoogleSheetsSortRange;
use OpenCompany\Integrations\Google\Tools\GoogleSheetsWriteRange;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class GoogleSheetsToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'google_sheets';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Google Sheets',
            'description' => 'Spreadsheet data management',
            'icon' => 'ph:table',
            'logo' => 'simple-icons:googlesheets',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Google Sheets',
            'description' => 'Read, write, and manage spreadsheet data',
            'icon' => 'ph:table',
            'logo' => 'simple-icons:googlesheets',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://console.cloud.google.com/apis/library/sheets.googleapis.com',
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
                'authorize_url' => '/api/integrations/google/oauth/authorize?service=google_sheets',
                'redirect_uri' => '/api/integrations/google/oauth/callback',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $connectedEmail = $config['connected_email'] ?? null;

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'Not connected. Click "Connect with Google Sheets" to authorize.'];
        }

        try {
            // Try to access a non-existent spreadsheet to verify auth
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
            ])->timeout(10)->get('https://sheets.googleapis.com/v4/spreadsheets/__test_connection__', [
                'fields' => 'spreadsheetId',
            ]);

            // 404 = auth works, spreadsheet not found (expected)
            // 401/403 = auth failed
            if ($response->status() === 404) {
                $emailInfo = $connectedEmail ? " ({$connectedEmail})" : '';

                return ['success' => true, 'message' => "Google Sheets connected{$emailInfo}."];
            }

            if ($response->successful()) {
                // Shouldn't happen with a fake ID, but handle it gracefully
                $emailInfo = $connectedEmail ? " ({$connectedEmail})" : '';

                return ['success' => true, 'message' => "Google Sheets connected{$emailInfo}."];
            }

            $error = $response->json('error.message') ?? $response->body();

            return [
                'success' => false,
                'error' => 'Sheets API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
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
        $service = app(GoogleSheetsService::class);

        return new $class($service);
    }
}
