<?php

namespace OpenCompany\Integrations\Wufoo;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Wufoo\Tools\WufooListForms;
use OpenCompany\Integrations\Wufoo\Tools\WufooGetForm;
use OpenCompany\Integrations\Wufoo\Tools\WufooListEntries;
use OpenCompany\Integrations\Wufoo\Tools\WufooGetEntry;
use OpenCompany\Integrations\Wufoo\Tools\WufooListReports;
use OpenCompany\Integrations\Wufoo\Tools\WufooGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\Integrations\Wufoo\Tools\WufooListFields;
use OpenCompany\Integrations\Wufoo\Tools\WufooSubmitEntry;

/**
 * Registers the integration provider and exposes its tools.
 */
class WufooToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
     * Get the application name identifier.
     */
    public function appName(): string
    {
        return 'wufoo';
    }

/**
     * Get application metadata for display and categorization.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Wufoo',
            'description' => 'Online form builder',
            'icon' => 'ph:clipboard-text',
            'logo' => 'simple-icons:wufoo',
        ];
    }

/**
     * Get integration metadata including category and documentation links.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Wufoo',
            'description' => 'Online form builder — collect entries, manage forms and reports',
            'icon' => 'ph:clipboard-text',
            'logo' => 'simple-icons:wufoo',
            'category' => 'forms',
            'badge' => 'verified',
            'docs_url' => 'https://wufoo.com/docs/api-v3/',
        ];
    }/**
     * Get the configuration schema for the Wufoo integration.
     *
     * Defines the fields needed to connect to the Wufoo API:
     * - api_key: The Wufoo API key for authentication.
     * - base_url: The subdomain-specific API base URL.
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Wufoo API key',
                'hint' => 'Find your API key at Wufoo → Your Name → Account → API Information',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://yoursubdomain.wufoo.com/api/v3',
                'hint' => 'Your Wufoo subdomain API URL. Format: <code>https://{subdomain}.wufoo.com/api/v3</code>',
                'default' => 'https://example.wufoo.com/api/v3',
            ],
        ];
    }

    /**
     * Test the connection to the Wufoo API using the provided configuration.
     *
     * @param  array<string, mixed>  $config  The configuration containing api_key and base_url.
     * @return array{success: bool, message?: string, error?: string} The connection test result.
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['base_url'] ?? 'https://example.wufoo.com/api/v3', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided.'];
        }

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->withBasicAuth($apiKey, 'footastic')->timeout(10)->get($baseUrl . '/users.json');

            if ($response->successful()) {
                $json = $response->json();
                $users = $json['Users'] ?? [];

                return [
                    'success' => true,
                    'message' => 'Connected to Wufoo API.' . (count($users) > 0 ? ' Found user: ' . ($users[0]['FirstName'] ?? 'Unknown') : ''),
                ];
            }

            $error = $response->json('error') ?? $response->body();

            return [
                'success' => false,
                'error' => 'Wufoo API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get the validation rules for the Wufoo configuration fields.
     *
     * @return array<string, string> Laravel validation rules.
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'base_url' => 'nullable|url',
        ];
    }

    /**
     * Get all available Wufoo tools with their metadata.
     *
     * @return array<string, array{class: string, type: string, name: string, description: string, icon: string}>
     */
        public function tools(): array
    {
        return [
            'wufoo_get_current_user' => [
                'class' => WufooGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated Wufoo user\'s profile. Returns account details such as name, email, and organization.',
                'icon' => 'ph:wrench',
            ],
            'wufoo_get_entry' => [
                'class' => WufooGetEntry::class,
                'type' => 'read',
                'name' => 'Get Entry',
                'description' => 'Get a single Wufoo form entry by its identifier. Returns all field values and submission metadata for the entry.',
                'icon' => 'ph:wrench',
            ],
            'wufoo_get_form' => [
                'class' => WufooGetForm::class,
                'type' => 'read',
                'name' => 'Get Form',
                'description' => 'Get details for a specific Wufoo form by its identifier. Returns the full form definition including fields, settings, and metadata.',
                'icon' => 'ph:wrench',
            ],
            'wufoo_list_entries' => [
                'class' => WufooListEntries::class,
                'type' => 'read',
                'name' => 'List Entries',
                'description' => 'List entries submitted to a Wufoo form. Supports pagination and optional filters to narrow results. Use the page and pageSize parameters to paginate through large result sets.',
                'icon' => 'ph:wrench',
            ],
            'wufoo_list_forms' => [
                'class' => WufooListForms::class,
                'type' => 'read',
                'name' => 'List Forms',
                'description' => 'List all forms in your Wufoo account. Returns form identifiers, names, descriptions, and metadata that can be used with other Wufoo tools.',
                'icon' => 'ph:wrench',
            ],
            'wufoo_list_reports' => [
                'class' => WufooListReports::class,
                'type' => 'read',
                'name' => 'List Reports',
                'description' => 'List all reports in your Wufoo account. Returns report identifiers, names, descriptions, and the forms they are associated with.',
                'icon' => 'ph:wrench',
            ],
        ];
    }


    /**
     * Get the path to the Lua documentation file for Wufoo tools.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/wufoo.md';
    }

    /**
     * Get the credential fields required for the Wufoo integration.
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://example.wufoo.com/api/v3'],
        ];
    }

    /**
     * Confirm this class represents an integration provider.
     */
    public function isIntegration(): bool
    {        return true;
    }

    /**
     * Create a tool instance, with optional account-specific credentials for multi-account support.
     *
     * @param  string  $class  The fully-qualified tool class name.
     * @param  array<string, mixed>  $context  Optional context containing an 'account' key for multi-account resolution.
     * @return Tool The instantiated tool with the appropriate service.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the WufooService, with optional account-specific credentials.
     *
     * When an account is provided in the context, creates a new service instance
     * with that account's credentials. Otherwise, resolves the default singleton.
     *
     * @param  array<string, mixed>  $context  Optional context with 'account' key.
     * @return WufooService The resolved service instance.
     */
    private function resolveService(array $context = []): WufooService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new WufooService(
                apiKey: $creds->get('wufoo', 'api_key', '', $account),
                baseUrl: $creds->get('wufoo', 'base_url', 'https://example.wufoo.com/api/v3', $account),
            );
        }

        return app(WufooService::class);
    }
}
