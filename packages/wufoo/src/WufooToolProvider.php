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
use OpenCompany\Integrations\Wufoo\Tools\WufooSubmitEntry;
use OpenCompany\Integrations\Wufoo\Tools\WufooListFields;
use OpenCompany\Integrations\Wufoo\Tools\WufooListReports;

class WufooToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * Get the machine name of this integration.
     */
    public function appName(): string
    {
        return 'wufoo';
    }

    /**
     * Get metadata for the app selector UI.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'forms, entries, fields, reports',
            'description' => 'Online form builder',
            'icon' => 'ph:clipboard-text',
            'logo' => 'simple-icons:wufoo',
        ];
    }

    /**
     * Get integration metadata for the integrations catalog.
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
            'docs_url' => 'https://wufoo.com/docs/api/v3/',
        ];
    }

    /**
     * Get the configuration schema for this integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Wufoo API key',
                'hint' => 'Find your API key in Wufoo under <strong>Account &rarr; Integration &rarr; Wufoo API</strong>',
                'required' => true,
            ],
            [
                'key' => 'subdomain',
                'type' => 'string',
                'label' => 'Subdomain',
                'placeholder' => 'mycompany',
                'hint' => 'Your Wufoo subdomain (the part before <code>.wufoo.com</code>)',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the connection to the Wufoo API with the given configuration.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $subdomain = $config['subdomain'] ?? '';

        if (empty($apiKey) || empty($subdomain)) {
            return ['success' => false, 'error' => 'API key and subdomain are required'];
        }

        try {
            $baseUrl = 'https://' . $subdomain . '.wufoo.com/api/v3';

            $response = Http::withBasicAuth($apiKey, 'foot')
                ->timeout(10)
                ->get($baseUrl . '/forms.json');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Wufoo API at {$baseUrl}. Check the subdomain and API key.",
                ];
            }

            $formCount = count($json['Forms'] ?? []);

            return [
                'success' => true,
                'message' => "Connected to Wufoo ({$subdomain}.wufoo.com). Found {$formCount} form(s).",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get Laravel validation rules for the configuration fields.
     *
     * @return array<string, string|array<int, string>>
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'required|string',
            'subdomain' => 'required|string',
        ];
    }

    /**
     * Get the list of tools provided by this integration.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'wufoo_list_forms' => [
                'class' => WufooListForms::class,
                'type' => 'read',
                'name' => 'List Forms',
                'description' => 'List all forms in the Wufoo account.',
                'icon' => 'ph:clipboard-text',
            ],
            'wufoo_get_form' => [
                'class' => WufooGetForm::class,
                'type' => 'read',
                'name' => 'Get Form',
                'description' => 'Get details for a specific form.',
                'icon' => 'ph:clipboard-text',
            ],
            'wufoo_list_entries' => [
                'class' => WufooListEntries::class,
                'type' => 'read',
                'name' => 'List Entries',
                'description' => 'List entries submitted to a form.',
                'icon' => 'ph:list-dashes',
            ],
            'wufoo_get_entry' => [
                'class' => WufooGetEntry::class,
                'type' => 'read',
                'name' => 'Get Entry',
                'description' => 'Get a single form entry by its ID.',
                'icon' => 'ph:file-text',
            ],
            'wufoo_submit_entry' => [
                'class' => WufooSubmitEntry::class,
                'type' => 'write',
                'name' => 'Submit Entry',
                'description' => 'Submit a new entry to a Wufoo form.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'wufoo_list_fields' => [
                'class' => WufooListFields::class,
                'type' => 'read',
                'name' => 'List Fields',
                'description' => 'List all fields for a specific form.',
                'icon' => 'ph:grid-four',
            ],
            'wufoo_list_reports' => [
                'class' => WufooListReports::class,
                'type' => 'read',
                'name' => 'List Reports',
                'description' => 'List all reports in the Wufoo account.',
                'icon' => 'ph:chart-bar',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/wufoo.md';
    }

    /**
     * Get the credential fields for account setup.
     *
     * @return array<int, array{key: string, type: string, label: string, required?: bool, default?: string}>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'subdomain', 'type' => 'string', 'label' => 'Subdomain', 'required' => true],
        ];
    }

    /**
     * Confirm this class represents an integration.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally using credentials from a specific account.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array{account?: mixed}  $context  Optional context with account override.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new WufooService(
                apiKey: $creds->get('wufoo', 'api_key', '', $account),
                subdomain: $creds->get('wufoo', 'subdomain', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(WufooService::class));
    }
}
