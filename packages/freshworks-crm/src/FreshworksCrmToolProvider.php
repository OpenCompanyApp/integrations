<?php

namespace OpenCompany\Integrations\FreshworksCrm;

use Exception;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Registers the Freshworks CRM integration and exposes sales CRM tools.
 */
class FreshworksCrmToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => [],
                'notes' => ['Base URL should end with /crm/sales.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal'],
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

    public function appName(): string
    {
        return 'freshworks-crm';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Freshworks CRM',
            'description' => 'Sales CRM',
            'icon' => 'ph:handshake',
            'logo' => 'simple-icons:freshworks',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Freshworks CRM',
            'description' => 'Sales CRM by Freshworks for contacts, accounts, deals, tasks, appointments, notes, activities, fields, lookup, and search.',
            'icon' => 'ph:handshake',
            'logo' => 'simple-icons:freshworks',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.freshworks.com/crm/api/',
        ];
    }

    /**
     * Get the settings schema for Freshworks CRM.
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
                'placeholder' => 'Enter your Freshworks CRM API key',
                'hint' => 'Find your API key in Freshworks CRM under Profile Settings > API Settings.',
                'required' => true,
            ],
            [
                'key' => 'domain',
                'type' => 'string',
                'label' => 'Domain',
                'placeholder' => 'mycompany',
                'hint' => 'Freshworks subdomain before .myfreshworks.com.',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'url',
                'label' => 'Custom Base URL',
                'placeholder' => 'https://mycompany.myfreshworks.com/crm/sales',
                'hint' => 'Override the generated Freshworks CRM sales URL.',
                'required' => false,
            ],
        ];
    }

    /**
     * Test the connection to Freshworks CRM.
     *
     * @param  array<string, mixed>  $config  Configuration containing api_key plus domain or base_url.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $domain = (string) ($config['domain'] ?? '');
        $baseUrl = (string) ($config['base_url'] ?? '');

        if ($apiKey === '') {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        if ($domain === '' && $baseUrl === '') {
            return ['success' => false, 'error' => 'No domain or base URL provided'];
        }

        $url = $baseUrl !== ''
            ? rtrim($baseUrl, '/')
            : "https://{$domain}.myfreshworks.com/crm/sales";

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Token token=' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($url . '/api/users/me');

            if (!$response->successful()) {
                return [
                    'success' => false,
                    'error' => "Could not connect to Freshworks CRM (HTTP {$response->status()}). Check your domain and API key.",
                ];
            }

            $json = $response->json() ?? [];
            $userName = $json['user']['first_name'] ?? $json['user']['name'] ?? 'User';

            return [
                'success' => true,
                'message' => "Connected to Freshworks CRM as {$userName}.",
            ];
        } catch (Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for configuration fields.
     *
     * @return array<string, mixed>
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'domain' => 'nullable|string',
            'base_url' => 'nullable|url',
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
            'freshworks_crm_list_contacts' => ['class' => 'OpenCompany\\Integrations\\FreshworksCrm\\Tools\\FreshworksCrmListContacts', 'type' => 'read', 'name' => 'List Contacts', 'description' => 'List contacts with pagination.', 'icon' => 'ph:users'],
            'freshworks_crm_get_contact' => ['class' => 'OpenCompany\\Integrations\\FreshworksCrm\\Tools\\FreshworksCrmGetContact', 'type' => 'read', 'name' => 'Get Contact', 'description' => 'Get a contact by ID.', 'icon' => 'ph:user'],
            'freshworks_crm_create_contact' => ['class' => 'OpenCompany\\Integrations\\FreshworksCrm\\Tools\\FreshworksCrmCreateContact', 'type' => 'write', 'name' => 'Create Contact', 'description' => 'Create a contact.', 'icon' => 'ph:user-plus'],
            'freshworks_crm_update_contact' => ['class' => 'OpenCompany\\Integrations\\FreshworksCrm\\Tools\\FreshworksCrmUpdateContact', 'type' => 'write', 'name' => 'Update Contact', 'description' => 'Update a contact.', 'icon' => 'ph:pencil-simple'],
            'freshworks_crm_delete_contact' => ['class' => 'OpenCompany\\Integrations\\FreshworksCrm\\Tools\\FreshworksCrmDeleteContact', 'type' => 'write', 'name' => 'Delete Contact', 'description' => 'Delete a contact.', 'icon' => 'ph:trash'],
            'freshworks_crm_list_contact_filters' => ['class' => 'OpenCompany\\Integrations\\FreshworksCrm\\Tools\\FreshworksCrmListContactFilters', 'type' => 'read', 'name' => 'List Contact Filters', 'description' => 'List contact filters.', 'icon' => 'ph:funnel'],
            'freshworks_crm_get_contact_view' => ['class' => 'OpenCompany\\Integrations\\FreshworksCrm\\Tools\\FreshworksCrmGetContactView', 'type' => 'read', 'name' => 'Get Contact View', 'description' => 'Fetch contacts from a view.', 'icon' => 'ph:table'],
            'freshworks_crm_bulk_upsert_contacts' => ['class' => 'OpenCompany\\Integrations\\FreshworksCrm\\Tools\\FreshworksCrmBulkUpsertContacts', 'type' => 'write', 'name' => 'Bulk Upsert Contacts', 'description' => 'Bulk upsert contacts.', 'icon' => 'ph:upload-simple'],
            'freshworks_crm_list_accounts' => ['class' => 'OpenCompany\\Integrations\\FreshworksCrm\\Tools\\FreshworksCrmListAccounts', 'type' => 'read', 'name' => 'List Accounts', 'description' => 'List sales accounts.', 'icon' => 'ph:buildings'],
            'freshworks_crm_get_account' => ['class' => 'OpenCompany\\Integrations\\FreshworksCrm\\Tools\\FreshworksCrmGetAccount', 'type' => 'read', 'name' => 'Get Account', 'description' => 'Get a sales account.', 'icon' => 'ph:building'],
            'freshworks_crm_create_account' => ['class' => 'OpenCompany\\Integrations\\FreshworksCrm\\Tools\\FreshworksCrmCreateAccount', 'type' => 'write', 'name' => 'Create Account', 'description' => 'Create a sales account.', 'icon' => 'ph:building-office'],
            'freshworks_crm_update_account' => ['class' => 'OpenCompany\\Integrations\\FreshworksCrm\\Tools\\FreshworksCrmUpdateAccount', 'type' => 'write', 'name' => 'Update Account', 'description' => 'Update a sales account.', 'icon' => 'ph:pencil-simple'],
            'freshworks_crm_delete_account' => ['class' => 'OpenCompany\\Integrations\\FreshworksCrm\\Tools\\FreshworksCrmDeleteAccount', 'type' => 'write', 'name' => 'Delete Account', 'description' => 'Delete a sales account.', 'icon' => 'ph:trash'],
            'freshworks_crm_list_account_filters' => ['class' => 'OpenCompany\\Integrations\\FreshworksCrm\\Tools\\FreshworksCrmListAccountFilters', 'type' => 'read', 'name' => 'List Account Filters', 'description' => 'List sales account filters.', 'icon' => 'ph:funnel'],
            'freshworks_crm_bulk_upsert_accounts' => ['class' => 'OpenCompany\\Integrations\\FreshworksCrm\\Tools\\FreshworksCrmBulkUpsertAccounts', 'type' => 'write', 'name' => 'Bulk Upsert Accounts', 'description' => 'Bulk upsert accounts.', 'icon' => 'ph:upload-simple'],
            'freshworks_crm_list_deals' => ['class' => 'OpenCompany\\Integrations\\FreshworksCrm\\Tools\\FreshworksCrmListDeals', 'type' => 'read', 'name' => 'List Deals', 'description' => 'List deals.', 'icon' => 'ph:currency-dollar'],
            'freshworks_crm_get_deal' => ['class' => 'OpenCompany\\Integrations\\FreshworksCrm\\Tools\\FreshworksCrmGetDeal', 'type' => 'read', 'name' => 'Get Deal', 'description' => 'Get a deal by ID.', 'icon' => 'ph:currency-dollar'],
            'freshworks_crm_create_deal' => ['class' => 'OpenCompany\\Integrations\\FreshworksCrm\\Tools\\FreshworksCrmCreateDeal', 'type' => 'write', 'name' => 'Create Deal', 'description' => 'Create a deal.', 'icon' => 'ph:plus-circle'],
            'freshworks_crm_update_deal' => ['class' => 'OpenCompany\\Integrations\\FreshworksCrm\\Tools\\FreshworksCrmUpdateDeal', 'type' => 'write', 'name' => 'Update Deal', 'description' => 'Update a deal.', 'icon' => 'ph:pencil-simple'],
            'freshworks_crm_delete_deal' => ['class' => 'OpenCompany\\Integrations\\FreshworksCrm\\Tools\\FreshworksCrmDeleteDeal', 'type' => 'write', 'name' => 'Delete Deal', 'description' => 'Delete a deal.', 'icon' => 'ph:trash'],
            'freshworks_crm_list_deal_filters' => ['class' => 'OpenCompany\\Integrations\\FreshworksCrm\\Tools\\FreshworksCrmListDealFilters', 'type' => 'read', 'name' => 'List Deal Filters', 'description' => 'List deal filters.', 'icon' => 'ph:funnel'],
            'freshworks_crm_get_deal_view' => ['class' => 'OpenCompany\\Integrations\\FreshworksCrm\\Tools\\FreshworksCrmGetDealView', 'type' => 'read', 'name' => 'Get Deal View', 'description' => 'Fetch deals from a view.', 'icon' => 'ph:table'],
            'freshworks_crm_bulk_upsert_deals' => ['class' => 'OpenCompany\\Integrations\\FreshworksCrm\\Tools\\FreshworksCrmBulkUpsertDeals', 'type' => 'write', 'name' => 'Bulk Upsert Deals', 'description' => 'Bulk upsert deals.', 'icon' => 'ph:upload-simple'],
            'freshworks_crm_list_tasks' => ['class' => 'OpenCompany\\Integrations\\FreshworksCrm\\Tools\\FreshworksCrmListTasks', 'type' => 'read', 'name' => 'List Tasks', 'description' => 'List tasks.', 'icon' => 'ph:check-square'],
            'freshworks_crm_get_task' => ['class' => 'OpenCompany\\Integrations\\FreshworksCrm\\Tools\\FreshworksCrmGetTask', 'type' => 'read', 'name' => 'Get Task', 'description' => 'Get a task.', 'icon' => 'ph:list-checks'],
            'freshworks_crm_create_task' => ['class' => 'OpenCompany\\Integrations\\FreshworksCrm\\Tools\\FreshworksCrmCreateTask', 'type' => 'write', 'name' => 'Create Task', 'description' => 'Create a task.', 'icon' => 'ph:check-square-offset'],
            'freshworks_crm_update_task' => ['class' => 'OpenCompany\\Integrations\\FreshworksCrm\\Tools\\FreshworksCrmUpdateTask', 'type' => 'write', 'name' => 'Update Task', 'description' => 'Update a task.', 'icon' => 'ph:pencil-simple'],
            'freshworks_crm_delete_task' => ['class' => 'OpenCompany\\Integrations\\FreshworksCrm\\Tools\\FreshworksCrmDeleteTask', 'type' => 'write', 'name' => 'Delete Task', 'description' => 'Delete a task.', 'icon' => 'ph:trash'],
            'freshworks_crm_list_appointments' => ['class' => 'OpenCompany\\Integrations\\FreshworksCrm\\Tools\\FreshworksCrmListAppointments', 'type' => 'read', 'name' => 'List Appointments', 'description' => 'List appointments.', 'icon' => 'ph:calendar'],
            'freshworks_crm_get_appointment' => ['class' => 'OpenCompany\\Integrations\\FreshworksCrm\\Tools\\FreshworksCrmGetAppointment', 'type' => 'read', 'name' => 'Get Appointment', 'description' => 'Get an appointment.', 'icon' => 'ph:calendar-check'],
            'freshworks_crm_create_appointment' => ['class' => 'OpenCompany\\Integrations\\FreshworksCrm\\Tools\\FreshworksCrmCreateAppointment', 'type' => 'write', 'name' => 'Create Appointment', 'description' => 'Create an appointment.', 'icon' => 'ph:calendar-plus'],
            'freshworks_crm_update_appointment' => ['class' => 'OpenCompany\\Integrations\\FreshworksCrm\\Tools\\FreshworksCrmUpdateAppointment', 'type' => 'write', 'name' => 'Update Appointment', 'description' => 'Update an appointment.', 'icon' => 'ph:pencil-simple'],
            'freshworks_crm_delete_appointment' => ['class' => 'OpenCompany\\Integrations\\FreshworksCrm\\Tools\\FreshworksCrmDeleteAppointment', 'type' => 'write', 'name' => 'Delete Appointment', 'description' => 'Delete an appointment.', 'icon' => 'ph:trash'],
            'freshworks_crm_create_note' => ['class' => 'OpenCompany\\Integrations\\FreshworksCrm\\Tools\\FreshworksCrmCreateNote', 'type' => 'write', 'name' => 'Create Note', 'description' => 'Create a note.', 'icon' => 'ph:note-pencil'],
            'freshworks_crm_get_note' => ['class' => 'OpenCompany\\Integrations\\FreshworksCrm\\Tools\\FreshworksCrmGetNote', 'type' => 'read', 'name' => 'Get Note', 'description' => 'Get a note.', 'icon' => 'ph:note'],
            'freshworks_crm_update_note' => ['class' => 'OpenCompany\\Integrations\\FreshworksCrm\\Tools\\FreshworksCrmUpdateNote', 'type' => 'write', 'name' => 'Update Note', 'description' => 'Update a note.', 'icon' => 'ph:pencil-simple'],
            'freshworks_crm_delete_note' => ['class' => 'OpenCompany\\Integrations\\FreshworksCrm\\Tools\\FreshworksCrmDeleteNote', 'type' => 'write', 'name' => 'Delete Note', 'description' => 'Delete a note.', 'icon' => 'ph:trash'],
            'freshworks_crm_create_phone_call' => ['class' => 'OpenCompany\\Integrations\\FreshworksCrm\\Tools\\FreshworksCrmCreatePhoneCall', 'type' => 'write', 'name' => 'Create Phone Call', 'description' => 'Create a manual phone call log.', 'icon' => 'ph:phone-call'],
            'freshworks_crm_list_sales_activities' => ['class' => 'OpenCompany\\Integrations\\FreshworksCrm\\Tools\\FreshworksCrmListSalesActivities', 'type' => 'read', 'name' => 'List Sales Activities', 'description' => 'List sales activities.', 'icon' => 'ph:list-bullets'],
            'freshworks_crm_get_sales_activity' => ['class' => 'OpenCompany\\Integrations\\FreshworksCrm\\Tools\\FreshworksCrmGetSalesActivity', 'type' => 'read', 'name' => 'Get Sales Activity', 'description' => 'Get a sales activity.', 'icon' => 'ph:clock-counter-clockwise'],
            'freshworks_crm_create_sales_activity' => ['class' => 'OpenCompany\\Integrations\\FreshworksCrm\\Tools\\FreshworksCrmCreateSalesActivity', 'type' => 'write', 'name' => 'Create Sales Activity', 'description' => 'Create a sales activity.', 'icon' => 'ph:plus-circle'],
            'freshworks_crm_update_sales_activity' => ['class' => 'OpenCompany\\Integrations\\FreshworksCrm\\Tools\\FreshworksCrmUpdateSalesActivity', 'type' => 'write', 'name' => 'Update Sales Activity', 'description' => 'Update a sales activity.', 'icon' => 'ph:pencil-simple'],
            'freshworks_crm_delete_sales_activity' => ['class' => 'OpenCompany\\Integrations\\FreshworksCrm\\Tools\\FreshworksCrmDeleteSalesActivity', 'type' => 'write', 'name' => 'Delete Sales Activity', 'description' => 'Delete a sales activity.', 'icon' => 'ph:trash'],
            'freshworks_crm_get_current_user' => ['class' => 'OpenCompany\\Integrations\\FreshworksCrm\\Tools\\FreshworksCrmGetCurrentUser', 'type' => 'read', 'name' => 'Get Current User', 'description' => 'Get the current user.', 'icon' => 'ph:identification-badge'],
            'freshworks_crm_search' => ['class' => 'OpenCompany\\Integrations\\FreshworksCrm\\Tools\\FreshworksCrmSearch', 'type' => 'read', 'name' => 'Search', 'description' => 'Run global search.', 'icon' => 'ph:magnifying-glass'],
            'freshworks_crm_lookup' => ['class' => 'OpenCompany\\Integrations\\FreshworksCrm\\Tools\\FreshworksCrmLookup', 'type' => 'read', 'name' => 'Lookup', 'description' => 'Run lookup search.', 'icon' => 'ph:binoculars'],
            'freshworks_crm_filtered_search_contact' => ['class' => 'OpenCompany\\Integrations\\FreshworksCrm\\Tools\\FreshworksCrmFilteredSearchContact', 'type' => 'read', 'name' => 'Filtered Search Contact', 'description' => 'Run filtered contact search.', 'icon' => 'ph:funnel'],
            'freshworks_crm_list_contact_fields' => ['class' => 'OpenCompany\\Integrations\\FreshworksCrm\\Tools\\FreshworksCrmListContactFields', 'type' => 'read', 'name' => 'List Contact Fields', 'description' => 'List contact fields.', 'icon' => 'ph:textbox'],
            'freshworks_crm_list_account_fields' => ['class' => 'OpenCompany\\Integrations\\FreshworksCrm\\Tools\\FreshworksCrmListAccountFields', 'type' => 'read', 'name' => 'List Account Fields', 'description' => 'List account fields.', 'icon' => 'ph:textbox'],
            'freshworks_crm_list_deal_fields' => ['class' => 'OpenCompany\\Integrations\\FreshworksCrm\\Tools\\FreshworksCrmListDealFields', 'type' => 'read', 'name' => 'List Deal Fields', 'description' => 'List deal fields.', 'icon' => 'ph:textbox'],
            'freshworks_crm_list_sales_activity_fields' => ['class' => 'OpenCompany\\Integrations\\FreshworksCrm\\Tools\\FreshworksCrmListSalesActivityFields', 'type' => 'read', 'name' => 'List Sales Activity Fields', 'description' => 'List sales activity fields.', 'icon' => 'ph:textbox'],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/freshworks-crm.md';
    }

    /**
     * Get credential field definitions.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'domain', 'type' => 'string', 'label' => 'Domain', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'Custom Base URL', 'required' => false],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally scoped to a specific account.
     *
     * @param  class-string<Tool>  $class  Tool class.
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve a Freshworks CRM service, including account-scoped credentials.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): FreshworksCrmService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);
            $get = static function (string $key, mixed $default = '') use ($creds, $account): mixed {
                $value = $creds->get('freshworks-crm', $key, null, $account);

                return $value !== null && $value !== ''
                    ? $value
                    : $creds->get('freshworks_crm', $key, $default, $account);
            };

            $domain = $get('domain');
            $baseUrl = $domain
                ? "https://{$domain}.myfreshworks.com/crm/sales"
                : $get('base_url');

            return new FreshworksCrmService(
                apiKey: $get('api_key'),
                baseUrl: $baseUrl,
            );
        }

        return app(FreshworksCrmService::class);
    }
}
