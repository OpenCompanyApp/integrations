<?php

namespace OpenCompany\Integrations\ZohoSheet;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\ZohoSheet\Tools\ZohoSheetListSpreadsheets;
use OpenCompany\Integrations\ZohoSheet\Tools\ZohoSheetGetSpreadsheet;
use OpenCompany\Integrations\ZohoSheet\Tools\ZohoSheetListWorksheets;
use OpenCompany\Integrations\ZohoSheet\Tools\ZohoSheetGetWorksheet;
use OpenCompany\Integrations\ZohoSheet\Tools\ZohoSheetListRows;
use OpenCompany\Integrations\ZohoSheet\Tools\ZohoSheetCreateRow;
use OpenCompany\Integrations\ZohoSheet\Tools\ZohoSheetGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class ZohoSheetToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
     * The application name used as the integration identifier.
     */
    public function appName(): string
    {
        return 'zoho_sheet';
    }

/**
     * Short metadata shown in tool listings and UI.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'spreadsheets, worksheets, rows',
            'description' => 'Spreadsheet management',
            'icon' => 'ph:table',
            'logo' => 'simple-icons:zoho',
        ];
    }

/**
     * Full integration metadata for the integrations UI.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Zoho Sheet',
            'description' => 'Cloud spreadsheet management — create, read, and manage spreadsheets, worksheets, and rows.',
            'icon' => 'ph:table',
            'logo' => 'simple-icons:zoho',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://sheet.zoho.com/apidoc.html',
        ];
    }/**
     * Configuration schema for the Zoho Sheet integration.
     *
     * Defines the fields shown in the integration setup UI:
     * - access_token: OAuth bearer token for API authentication.
     * - url: Configurable base URL (default: https://sheet.zoho.com).
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Zoho OAuth access token',
                'hint' => 'Generate an OAuth access token from your Zoho account with ZohoSheet scope permissions',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://sheet.zoho.com',
                'hint' => 'Use <code>https://sheet.zoho.com</code> for the default region, or your regional Zoho URL (e.g., <code>https://sheet.zoho.eu</code>)',
                'default' => 'https://sheet.zoho.com',
            ],
        ];
    }

    /**
     * Test the connection to the Zoho Sheet API using the provided config.
     *
     * Calls the /api/v2/users/me endpoint to verify authentication.
     *
     * @param  array<string, mixed>  $config  Configuration containing 'access_token' and optionally 'url'.
     * @return array{success: bool, message?: string, error?: string} Connection test result.
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://sheet.zoho.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/api/v2/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Zoho Sheet API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                return [
                    'success' => false,
                    'error' => "Authentication failed (HTTP {$response->status()}). Check your access token.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Zoho Sheet API at {$baseUrl}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Laravel validation rules for the configuration fields.
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Register all Zoho Sheet tools.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'zoho_sheet_list_spreadsheets' => [
                'class' => ZohoSheetListSpreadsheets::class,
                'type' => 'read',
                'name' => 'List Spreadsheets',
                'description' => 'List all spreadsheets accessible to the authenticated user.',
                'icon' => 'ph:table',
            ],
            'zoho_sheet_get_spreadsheet' => [
                'class' => ZohoSheetGetSpreadsheet::class,
                'type' => 'read',
                'name' => 'Get Spreadsheet',
                'description' => 'Get details of a specific spreadsheet.',
                'icon' => 'ph:file-spreadsheet',
            ],
            'zoho_sheet_list_worksheets' => [
                'class' => ZohoSheetListWorksheets::class,
                'type' => 'read',
                'name' => 'List Worksheets',
                'description' => 'List all worksheets within a spreadsheet.',
                'icon' => 'ph:columns',
            ],
            'zoho_sheet_get_worksheet' => [
                'class' => ZohoSheetGetWorksheet::class,
                'type' => 'read',
                'name' => 'Get Worksheet',
                'description' => 'Get details of a specific worksheet.',
                'icon' => 'ph:columns',
            ],
            'zoho_sheet_list_rows' => [
                'class' => ZohoSheetListRows::class,
                'type' => 'read',
                'name' => 'List Rows',
                'description' => 'List rows in a worksheet with pagination.',
                'icon' => 'ph:list',
            ],
            'zoho_sheet_create_row' => [
                'class' => ZohoSheetCreateRow::class,
                'type' => 'write',
                'name' => 'Create Row',
                'description' => 'Add a new row of data to a worksheet.',
                'icon' => 'ph:plus',
            ],
            'zoho_sheet_get_current_user' => [
                'class' => ZohoSheetGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s profile information.',
                'icon' => 'ph:user',
            ],
        ];
    }

    /**
     * Path to the Lua API documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/zoho-sheet.md';
    }

    /**
     * Credential fields used for multi-account setup.
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://sheet.zoho.com'],
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
     * Create a tool instance, optionally using account-specific credentials.
     *
     * When an account context is provided, resolves credentials for that specific
     * account and creates a fresh ZohoSheetService. Otherwise, uses the app-container
     * singleton service.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Context containing optional 'account' key.
     */
    public function createTool(string $class, array $context = []): Tool
    {        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new ZohoSheetService(
                accessToken: $creds->get('zoho_sheet', 'access_token', '', $account),
                baseUrl: $creds->get('zoho_sheet', 'url', 'https://sheet.zoho.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(ZohoSheetService::class));
    }
}
