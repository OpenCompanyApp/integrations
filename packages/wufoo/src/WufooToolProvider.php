<?php

namespace OpenCompany\Integrations\Wufoo;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Wufoo\Tools\WufooAddWebhook;
use OpenCompany\Integrations\Wufoo\Tools\WufooApiDelete;
use OpenCompany\Integrations\Wufoo\Tools\WufooApiGet;
use OpenCompany\Integrations\Wufoo\Tools\WufooApiPost;
use OpenCompany\Integrations\Wufoo\Tools\WufooApiPut;
use OpenCompany\Integrations\Wufoo\Tools\WufooCountEntries;
use OpenCompany\Integrations\Wufoo\Tools\WufooCountFormComments;
use OpenCompany\Integrations\Wufoo\Tools\WufooCountReportEntries;
use OpenCompany\Integrations\Wufoo\Tools\WufooDeleteWebhook;
use OpenCompany\Integrations\Wufoo\Tools\WufooGetCurrentUser;
use OpenCompany\Integrations\Wufoo\Tools\WufooGetEntry;
use OpenCompany\Integrations\Wufoo\Tools\WufooGetForm;
use OpenCompany\Integrations\Wufoo\Tools\WufooGetReport;
use OpenCompany\Integrations\Wufoo\Tools\WufooListEntries;
use OpenCompany\Integrations\Wufoo\Tools\WufooListFields;
use OpenCompany\Integrations\Wufoo\Tools\WufooListFormComments;
use OpenCompany\Integrations\Wufoo\Tools\WufooListForms;
use OpenCompany\Integrations\Wufoo\Tools\WufooListReportEntries;
use OpenCompany\Integrations\Wufoo\Tools\WufooListReportFields;
use OpenCompany\Integrations\Wufoo\Tools\WufooListReports;
use OpenCompany\Integrations\Wufoo\Tools\WufooListReportWidgets;
use OpenCompany\Integrations\Wufoo\Tools\WufooListUsers;
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
                'setup_flows' => [
                    'manual_secret',
                ],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => [
                    'api_key',
                ],
                'notes' => [],
            ],
            'host_availability' => [
                'web' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_secret',
                ],
                'cli' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_secret',
                    'runtime_mode' => 'normal',
                ],
            ],
            'runtime_requirements' => [],
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
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://wufoo.github.io/docs/',
        ];
    }

    /**
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
            'api_key' => 'required|string',
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
                'description' => 'Get the authenticated Wufoo user profile. This is kept as a compatibility alias for the users endpoint.',
                'icon' => 'ph:user-circle',
            ],
            'wufoo_list_users' => [
                'class' => WufooListUsers::class,
                'type' => 'read',
                'name' => 'List Users',
                'description' => 'List Wufoo account users visible to the API key.',
                'icon' => 'ph:users',
                'parameters' => [
                    'params' => ['type' => 'object', 'description' => 'Optional query parameters such as pretty.'],
                ],
            ],
            'wufoo_list_forms' => [
                'class' => WufooListForms::class,
                'type' => 'read',
                'name' => 'List Forms',
                'description' => 'List all forms in your Wufoo account.',
                'icon' => 'ph:clipboard-text',
            ],
            'wufoo_get_form' => [
                'class' => WufooGetForm::class,
                'type' => 'read',
                'name' => 'Get Form',
                'description' => 'Get details for a specific Wufoo form.',
                'icon' => 'ph:clipboard-text',
            ],
            'wufoo_list_fields' => [
                'class' => WufooListFields::class,
                'type' => 'read',
                'name' => 'List Fields',
                'description' => 'List field definitions for a specific Wufoo form.',
                'icon' => 'ph:list-checks',
            ],
            'wufoo_list_entries' => [
                'class' => WufooListEntries::class,
                'type' => 'read',
                'name' => 'List Entries',
                'description' => 'List entries submitted to a Wufoo form with pagination, sorting, and filters.',
                'icon' => 'ph:table',
            ],
            'wufoo_count_entries' => [
                'class' => WufooCountEntries::class,
                'type' => 'read',
                'name' => 'Count Entries',
                'description' => 'Count entries submitted to a Wufoo form with optional filters.',
                'icon' => 'ph:hash',
                'parameters' => [
                    'form_id' => ['type' => 'string', 'required' => true, 'description' => 'The form hash or title identifier.'],
                    'params' => ['type' => 'object', 'description' => 'Optional query parameters such as Filter1, Match, or pretty.'],
                ],
            ],
            'wufoo_get_entry' => [
                'class' => WufooGetEntry::class,
                'type' => 'read',
                'name' => 'Get Entry',
                'description' => 'Find a single Wufoo form entry by form ID and entry ID using the documented form entries endpoint.',
                'icon' => 'ph:article',
            ],
            'wufoo_submit_entry' => [
                'class' => WufooSubmitEntry::class,
                'type' => 'write',
                'name' => 'Submit Entry',
                'description' => 'Submit a new entry to a Wufoo form using API field IDs.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'wufoo_list_form_comments' => [
                'class' => WufooListFormComments::class,
                'type' => 'read',
                'name' => 'List Form Comments',
                'description' => 'List comments made on entries for a Wufoo form.',
                'icon' => 'ph:chat-circle-text',
                'parameters' => [
                    'form_id' => ['type' => 'string', 'required' => true, 'description' => 'The form hash or title identifier.'],
                    'params' => ['type' => 'object', 'description' => 'Optional query parameters such as entryId, pageStart, pageSize, or pretty.'],
                ],
            ],
            'wufoo_count_form_comments' => [
                'class' => WufooCountFormComments::class,
                'type' => 'read',
                'name' => 'Count Form Comments',
                'description' => 'Count comments made on entries for a Wufoo form.',
                'icon' => 'ph:hash',
                'parameters' => [
                    'form_id' => ['type' => 'string', 'required' => true, 'description' => 'The form hash or title identifier.'],
                    'params' => ['type' => 'object', 'description' => 'Optional query parameters such as pretty.'],
                ],
            ],
            'wufoo_list_reports' => [
                'class' => WufooListReports::class,
                'type' => 'read',
                'name' => 'List Reports',
                'description' => 'List all reports in your Wufoo account.',
                'icon' => 'ph:chart-bar',
            ],
            'wufoo_get_report' => [
                'class' => WufooGetReport::class,
                'type' => 'read',
                'name' => 'Get Report',
                'description' => 'Get details for a specific Wufoo report.',
                'icon' => 'ph:chart-bar',
                'parameters' => [
                    'report_id' => ['type' => 'string', 'required' => true, 'description' => 'The report hash or title identifier.'],
                ],
            ],
            'wufoo_list_report_entries' => [
                'class' => WufooListReportEntries::class,
                'type' => 'read',
                'name' => 'List Report Entries',
                'description' => 'List entries exposed by a Wufoo report.',
                'icon' => 'ph:table',
                'parameters' => [
                    'report_id' => ['type' => 'string', 'required' => true, 'description' => 'The report hash or title identifier.'],
                    'params' => ['type' => 'object', 'description' => 'Optional query parameters such as pageStart, pageSize, sort, sortDirection, Filter1, or Match.'],
                ],
            ],
            'wufoo_count_report_entries' => [
                'class' => WufooCountReportEntries::class,
                'type' => 'read',
                'name' => 'Count Report Entries',
                'description' => 'Count entries exposed by a Wufoo report.',
                'icon' => 'ph:hash',
                'parameters' => [
                    'report_id' => ['type' => 'string', 'required' => true, 'description' => 'The report hash or title identifier.'],
                    'params' => ['type' => 'object', 'description' => 'Optional query parameters such as pretty.'],
                ],
            ],
            'wufoo_list_report_fields' => [
                'class' => WufooListReportFields::class,
                'type' => 'read',
                'name' => 'List Report Fields',
                'description' => 'List field definitions used by a Wufoo report.',
                'icon' => 'ph:list-checks',
                'parameters' => [
                    'report_id' => ['type' => 'string', 'required' => true, 'description' => 'The report hash or title identifier.'],
                    'params' => ['type' => 'object', 'description' => 'Optional query parameters such as system or pretty.'],
                ],
            ],
            'wufoo_list_report_widgets' => [
                'class' => WufooListReportWidgets::class,
                'type' => 'read',
                'name' => 'List Report Widgets',
                'description' => 'List widgets configured on a Wufoo report.',
                'icon' => 'ph:squares-four',
                'parameters' => [
                    'report_id' => ['type' => 'string', 'required' => true, 'description' => 'The report hash or title identifier.'],
                    'params' => ['type' => 'object', 'description' => 'Optional query parameters such as pretty.'],
                ],
            ],
            'wufoo_add_webhook' => [
                'class' => WufooAddWebhook::class,
                'type' => 'write',
                'name' => 'Add Webhook',
                'description' => 'Add a webhook to a Wufoo form.',
                'icon' => 'ph:webhooks-logo',
                'parameters' => [
                    'form_id' => ['type' => 'string', 'required' => true, 'description' => 'The form hash or title identifier.'],
                    'url' => ['type' => 'string', 'required' => true, 'description' => 'The HTTPS endpoint Wufoo should call.'],
                    'handshake_key' => ['type' => 'string', 'description' => 'Optional shared secret sent with webhook payloads.'],
                    'metadata' => ['type' => 'boolean', 'description' => 'Whether Wufoo should include form and field metadata. Default: false.'],
                ],
            ],
            'wufoo_delete_webhook' => [
                'class' => WufooDeleteWebhook::class,
                'type' => 'write',
                'name' => 'Delete Webhook',
                'description' => 'Delete a webhook from a Wufoo form.',
                'icon' => 'ph:trash',
                'parameters' => [
                    'form_id' => ['type' => 'string', 'required' => true, 'description' => 'The form hash or title identifier.'],
                    'webhook_id' => ['type' => 'string', 'required' => true, 'description' => 'The webhook hash identifier.'],
                ],
            ],
            'wufoo_api_get' => [
                'class' => WufooApiGet::class,
                'type' => 'read',
                'name' => 'Wufoo API GET',
                'description' => 'Call a documented Wufoo API v3 GET endpoint.',
                'icon' => 'ph:terminal-window',
                'parameters' => [
                    'path' => ['type' => 'string', 'required' => true, 'description' => 'Endpoint path, such as /forms.json.'],
                    'params' => ['type' => 'object', 'description' => 'Optional query parameters.'],
                ],
            ],
            'wufoo_api_post' => [
                'class' => WufooApiPost::class,
                'type' => 'write',
                'name' => 'Wufoo API POST',
                'description' => 'Call a documented Wufoo API v3 POST endpoint.',
                'icon' => 'ph:terminal-window',
                'parameters' => [
                    'path' => ['type' => 'string', 'required' => true, 'description' => 'Endpoint path, such as /forms/{id}/entries.json.'],
                    'body' => ['type' => 'object', 'description' => 'Form-encoded body fields.'],
                ],
            ],
            'wufoo_api_put' => [
                'class' => WufooApiPut::class,
                'type' => 'write',
                'name' => 'Wufoo API PUT',
                'description' => 'Call a documented Wufoo API v3 PUT endpoint.',
                'icon' => 'ph:terminal-window',
                'parameters' => [
                    'path' => ['type' => 'string', 'required' => true, 'description' => 'Endpoint path, such as /forms/{id}/webhooks.json.'],
                    'body' => ['type' => 'object', 'description' => 'Form-encoded body fields.'],
                ],
            ],
            'wufoo_api_delete' => [
                'class' => WufooApiDelete::class,
                'type' => 'write',
                'name' => 'Wufoo API DELETE',
                'description' => 'Call a documented Wufoo API v3 DELETE endpoint.',
                'icon' => 'ph:terminal-window',
                'parameters' => [
                    'path' => ['type' => 'string', 'required' => true, 'description' => 'Endpoint path, such as /forms/{id}/webhooks/{webhook_id}.json.'],
                    'params' => ['type' => 'object', 'description' => 'Optional request parameters.'],
                ],
            ],
        ];
    }


    /**
     * Get the path to the JavaScript documentation file for Wufoo tools.
     */
    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/wufoo.md';
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
