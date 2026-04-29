<?php

namespace OpenCompany\Integrations\ChurnZero;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\ChurnZero\Tools\ChurnZeroListAccounts;
use OpenCompany\Integrations\ChurnZero\Tools\ChurnZeroGetAccount;
use OpenCompany\Integrations\ChurnZero\Tools\ChurnZeroListContacts;
use OpenCompany\Integrations\ChurnZero\Tools\ChurnZeroGetContact;
use OpenCompany\Integrations\ChurnZero\Tools\ChurnZeroListAlerts;
use OpenCompany\Integrations\ChurnZero\Tools\ChurnZeroListUsage;
use OpenCompany\Integrations\ChurnZero\Tools\ChurnZeroGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class ChurnZeroToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'api_key',
            'legacy_auth_type' => 'api_key',
            'credential_mode' => 'secret',
            'setup_flows' =>
            [
              0 => 'manual_secret',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
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
              'setup_mode' => 'manual_secret',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_secret',
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
     * Get the application identifier for this integration.
     */
    public function appName(): string
    {
        return 'churnzero';
    }

/**
     * Get short metadata describing the integration's capabilities.
     */
    public function appMeta(): array
    {
        return [
            'label'       => 'ChurnZero',
            'description' => 'Customer success platform',
            'icon'        => 'ph:chart-line-up',
            'logo'        => 'simple-icons:churnzero',
        ];
    }

/**
     * Get full integration metadata for display and categorization.
     */
    public function integrationMeta(): array
    {
        return [
            'name'        => 'ChurnZero',
            'description' => 'Customer success platform for reducing churn and driving retention',
            'icon'        => 'ph:chart-line-up',
            'logo'        => 'simple-icons:churnzero',
            'category'    => 'sales',
            'badge'       => 'verified',
            'docs_url'    => 'https://support.churnzero.net/hc/en-us/articles/360009701791-ChurnZero-API',
        ];
    }/**
     * Get the configuration schema for the ChurnZero integration settings UI.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key'         => 'api_key',
                'type'        => 'secret',
                'label'       => 'API Key',
                'placeholder' => 'Enter your ChurnZero API key',
                'hint'        => 'Find your API key in ChurnZero under Administration > API Keys',
                'required'    => true,
            ],
            [
                'key'         => 'url',
                'type'        => 'url',
                'label'       => 'API Base URL',
                'placeholder' => 'https://api.churnzero.net/v1',
                'hint'        => 'Change only if using a custom ChurnZero API endpoint',
                'default'     => 'https://api.churnzero.net/v1',
            ],
        ];
    }

    /**
     * Test the connection to the ChurnZero API using the provided config.
     *
     * @param  array<string, mixed>  $config  Configuration containing api_key and optionally url.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey  = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.churnzero.net/v1', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withToken($apiKey)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->timeout(10)
                ->get($baseUrl . '/user');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error'   => "Could not reach ChurnZero API at {$baseUrl}. Check the URL.",
                ];
            }

            $name = trim(($json['firstName'] ?? '') . ' ' . ($json['lastName'] ?? ''));
            $org  = $json['tenantName'] ?? '';

            return [
                'success' => true,
                'message' => "Connected to ChurnZero API as {$name}" . ($org ? " ({$org})" : '') . '.',
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the configuration fields.
     *
     * @return array<string, mixed>
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url'     => 'nullable|url',
        ];
    }

    /**
     * Get all tools provided by this integration.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'churnzero_list_accounts' => [
                'class'       => ChurnZeroListAccounts::class,
                'type'        => 'read',
                'name'        => 'List Accounts',
                'description' => 'Search and list accounts in ChurnZero.',
                'icon'        => 'ph:buildings',
            ],
            'churnzero_get_account' => [
                'class'       => ChurnZeroGetAccount::class,
                'type'        => 'read',
                'name'        => 'Get Account',
                'description' => 'Get details for a single account.',
                'icon'        => 'ph:building',
            ],
            'churnzero_list_contacts' => [
                'class'       => ChurnZeroListContacts::class,
                'type'        => 'read',
                'name'        => 'List Contacts',
                'description' => 'List contacts in ChurnZero.',
                'icon'        => 'ph:users',
            ],
            'churnzero_get_contact' => [
                'class'       => ChurnZeroGetContact::class,
                'type'        => 'read',
                'name'        => 'Get Contact',
                'description' => 'Get details for a single contact.',
                'icon'        => 'ph:user',
            ],
            'churnzero_list_alerts' => [
                'class'       => ChurnZeroListAlerts::class,
                'type'        => 'read',
                'name'        => 'List Alerts',
                'description' => 'List alerts in ChurnZero.',
                'icon'        => 'ph:bell',
            ],
            'churnzero_list_usage' => [
                'class'       => ChurnZeroListUsage::class,
                'type'        => 'read',
                'name'        => 'List Usage',
                'description' => 'List usage data in ChurnZero.',
                'icon'        => 'ph:chart-bar',
            ],
            'churnzero_get_current_user' => [
                'class'       => ChurnZeroGetCurrentUser::class,
                'type'        => 'read',
                'name'        => 'Get Current User',
                'description' => 'Get the authenticated user profile.',
                'icon'        => 'ph:user-circle',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/churnzero.md';
    }

    /**
     * Get credential field definitions for the integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.churnzero.net/v1'],
        ];
    }

    /**
     * Confirm this class represents an integration.
     */
    public function isIntegration(): bool
    {        return true;
    }

    /**
     * Create a tool instance, optionally scoped to a specific account.
     *
     * When an account context is provided, credentials are resolved for that
     * specific account. Otherwise the default app-bound service is used.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Context containing optional 'account' key.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new ChurnZeroService(
                apiKey: $creds->get('churnzero', 'api_key', '', $account),
                baseUrl: $creds->get('churnzero', 'url', 'https://api.churnzero.net/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(ChurnZeroService::class));
    }
}
