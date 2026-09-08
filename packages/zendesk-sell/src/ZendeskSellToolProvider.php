<?php

namespace OpenCompany\Integrations\ZendeskSell;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Registers Zendesk Sell CRM tools and setup metadata.
 *
 * Exposes core CRM records, activities, products, users, pipelines, stages,
 * and source/reason reference data from the Zendesk Sell v2 API.
 */
class ZendeskSellToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'strategy' => 'bearer_token',
                'legacy_auth_type' => 'oauth',
                'credential_mode' => 'stored_token',
                'setup_flows' => ['manual_token'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['access_token'],
                'notes' => [],
            ],
            'host_availability' => [
                'web' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_token',
                ],
                'cli' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_token',
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

    public function appName(): string
    {
        return 'zendesk-sell';
    }

    /**
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Zendesk Sell',
            'description' => 'Sales CRM records, activities, products, and pipeline metadata',
            'icon' => 'ph:handshake',
            'logo' => 'simple-icons:zendesk',
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Zendesk Sell',
            'description' => 'Sales CRM for managing contacts, leads, deals, activities, products, pipelines, stages, users, and reference data.',
            'icon' => 'ph:handshake',
            'logo' => 'simple-icons:zendesk',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developer.zendesk.com/api-reference/sales-crm/resources/introduction/',
        ];
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Zendesk Sell access token',
                'hint' => 'Generate a personal access token in Zendesk Sell under Settings > Integrations > API.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.getbase.com',
                'hint' => 'Use https://api.getbase.com for the standard Zendesk Sell API.',
                'default' => 'https://api.getbase.com',
            ],
        ];
    }

    /**
     * Test the connection to the Zendesk Sell API.
     *
     * @param  array<string, mixed>  $config  Configuration containing access_token and url.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.getbase.com', '/');

        if ($accessToken === '') {
            return ['success' => false, 'error' => 'No access token provided.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/v2/users/me');

            if (!$response->successful()) {
                return [
                    'success' => false,
                    'error' => "Authentication failed (HTTP {$response->status()}). Check your access token.",
                ];
            }

            $json = $response->json();
            $userName = trim(($json['data']['first_name'] ?? '') . ' ' . ($json['data']['last_name'] ?? ''));

            return [
                'success' => true,
                'message' => $userName !== '' ? "Connected to Zendesk Sell as {$userName}." : 'Connected to Zendesk Sell.',
            ];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * @return array<string, string|array<int, string>>
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
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
            'zendesk_sell_create_contact' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellCreateContact', 'type' => 'write', 'name' => 'Create Contact', 'description' => 'Create Contact in Zendesk Sell.', 'icon' => 'ph:plus-circle'],
            'zendesk_sell_create_deal' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellCreateDeal', 'type' => 'write', 'name' => 'Create Deal', 'description' => 'Create Deal in Zendesk Sell.', 'icon' => 'ph:plus-circle'],
            'zendesk_sell_create_deal_source' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellCreateDealSource', 'type' => 'write', 'name' => 'Create Deal Source', 'description' => 'Create Deal Source in Zendesk Sell.', 'icon' => 'ph:plus-circle'],
            'zendesk_sell_create_lead' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellCreateLead', 'type' => 'write', 'name' => 'Create Lead', 'description' => 'Create Lead in Zendesk Sell.', 'icon' => 'ph:plus-circle'],
            'zendesk_sell_create_lead_source' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellCreateLeadSource', 'type' => 'write', 'name' => 'Create Lead Source', 'description' => 'Create Lead Source in Zendesk Sell.', 'icon' => 'ph:plus-circle'],
            'zendesk_sell_create_loss_reason' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellCreateLossReason', 'type' => 'write', 'name' => 'Create Loss Reason', 'description' => 'Create Loss Reason in Zendesk Sell.', 'icon' => 'ph:plus-circle'],
            'zendesk_sell_create_note' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellCreateNote', 'type' => 'write', 'name' => 'Create Note', 'description' => 'Create Note in Zendesk Sell.', 'icon' => 'ph:plus-circle'],
            'zendesk_sell_create_product' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellCreateProduct', 'type' => 'write', 'name' => 'Create Product', 'description' => 'Create Product in Zendesk Sell.', 'icon' => 'ph:plus-circle'],
            'zendesk_sell_create_task' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellCreateTask', 'type' => 'write', 'name' => 'Create Task', 'description' => 'Create Task in Zendesk Sell.', 'icon' => 'ph:plus-circle'],
            'zendesk_sell_delete_contact' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellDeleteContact', 'type' => 'write', 'name' => 'Delete Contact', 'description' => 'Delete Contact in Zendesk Sell.', 'icon' => 'ph:trash'],
            'zendesk_sell_delete_deal' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellDeleteDeal', 'type' => 'write', 'name' => 'Delete Deal', 'description' => 'Delete Deal in Zendesk Sell.', 'icon' => 'ph:trash'],
            'zendesk_sell_delete_deal_source' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellDeleteDealSource', 'type' => 'write', 'name' => 'Delete Deal Source', 'description' => 'Delete Deal Source in Zendesk Sell.', 'icon' => 'ph:trash'],
            'zendesk_sell_delete_lead' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellDeleteLead', 'type' => 'write', 'name' => 'Delete Lead', 'description' => 'Delete Lead in Zendesk Sell.', 'icon' => 'ph:trash'],
            'zendesk_sell_delete_lead_source' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellDeleteLeadSource', 'type' => 'write', 'name' => 'Delete Lead Source', 'description' => 'Delete Lead Source in Zendesk Sell.', 'icon' => 'ph:trash'],
            'zendesk_sell_delete_loss_reason' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellDeleteLossReason', 'type' => 'write', 'name' => 'Delete Loss Reason', 'description' => 'Delete Loss Reason in Zendesk Sell.', 'icon' => 'ph:trash'],
            'zendesk_sell_delete_note' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellDeleteNote', 'type' => 'write', 'name' => 'Delete Note', 'description' => 'Delete Note in Zendesk Sell.', 'icon' => 'ph:trash'],
            'zendesk_sell_delete_product' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellDeleteProduct', 'type' => 'write', 'name' => 'Delete Product', 'description' => 'Delete Product in Zendesk Sell.', 'icon' => 'ph:trash'],
            'zendesk_sell_delete_task' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellDeleteTask', 'type' => 'write', 'name' => 'Delete Task', 'description' => 'Delete Task in Zendesk Sell.', 'icon' => 'ph:trash'],
            'zendesk_sell_get_contact' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellGetContact', 'type' => 'read', 'name' => 'Get Contact', 'description' => 'Get Contact in Zendesk Sell.', 'icon' => 'ph:info'],
            'zendesk_sell_get_current_user' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellGetCurrentUser', 'type' => 'read', 'name' => 'Get Current User', 'description' => 'Get Current User in Zendesk Sell.', 'icon' => 'ph:info'],
            'zendesk_sell_get_deal' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellGetDeal', 'type' => 'read', 'name' => 'Get Deal', 'description' => 'Get Deal in Zendesk Sell.', 'icon' => 'ph:info'],
            'zendesk_sell_get_deal_source' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellGetDealSource', 'type' => 'read', 'name' => 'Get Deal Source', 'description' => 'Get Deal Source in Zendesk Sell.', 'icon' => 'ph:info'],
            'zendesk_sell_get_lead' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellGetLead', 'type' => 'read', 'name' => 'Get Lead', 'description' => 'Get Lead in Zendesk Sell.', 'icon' => 'ph:info'],
            'zendesk_sell_get_lead_source' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellGetLeadSource', 'type' => 'read', 'name' => 'Get Lead Source', 'description' => 'Get Lead Source in Zendesk Sell.', 'icon' => 'ph:info'],
            'zendesk_sell_get_loss_reason' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellGetLossReason', 'type' => 'read', 'name' => 'Get Loss Reason', 'description' => 'Get Loss Reason in Zendesk Sell.', 'icon' => 'ph:info'],
            'zendesk_sell_get_note' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellGetNote', 'type' => 'read', 'name' => 'Get Note', 'description' => 'Get Note in Zendesk Sell.', 'icon' => 'ph:info'],
            'zendesk_sell_get_pipeline' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellGetPipeline', 'type' => 'read', 'name' => 'Get Pipeline', 'description' => 'Get Pipeline in Zendesk Sell.', 'icon' => 'ph:info'],
            'zendesk_sell_get_product' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellGetProduct', 'type' => 'read', 'name' => 'Get Product', 'description' => 'Get Product in Zendesk Sell.', 'icon' => 'ph:info'],
            'zendesk_sell_get_stage' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellGetStage', 'type' => 'read', 'name' => 'Get Stage', 'description' => 'Get Stage in Zendesk Sell.', 'icon' => 'ph:info'],
            'zendesk_sell_get_task' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellGetTask', 'type' => 'read', 'name' => 'Get Task', 'description' => 'Get Task in Zendesk Sell.', 'icon' => 'ph:info'],
            'zendesk_sell_get_user' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellGetUser', 'type' => 'read', 'name' => 'Get User', 'description' => 'Get User in Zendesk Sell.', 'icon' => 'ph:info'],
            'zendesk_sell_list_contacts' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellListContacts', 'type' => 'read', 'name' => 'List Contacts', 'description' => 'List Contacts in Zendesk Sell.', 'icon' => 'ph:list'],
            'zendesk_sell_list_deal_sources' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellListDealSources', 'type' => 'read', 'name' => 'List Deal Sources', 'description' => 'List Deal Sources in Zendesk Sell.', 'icon' => 'ph:list'],
            'zendesk_sell_list_deals' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellListDeals', 'type' => 'read', 'name' => 'List Deals', 'description' => 'List Deals in Zendesk Sell.', 'icon' => 'ph:list'],
            'zendesk_sell_list_lead_sources' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellListLeadSources', 'type' => 'read', 'name' => 'List Lead Sources', 'description' => 'List Lead Sources in Zendesk Sell.', 'icon' => 'ph:list'],
            'zendesk_sell_list_leads' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellListLeads', 'type' => 'read', 'name' => 'List Leads', 'description' => 'List Leads in Zendesk Sell.', 'icon' => 'ph:list'],
            'zendesk_sell_list_loss_reasons' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellListLossReasons', 'type' => 'read', 'name' => 'List Loss Reasons', 'description' => 'List Loss Reasons in Zendesk Sell.', 'icon' => 'ph:list'],
            'zendesk_sell_list_notes' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellListNotes', 'type' => 'read', 'name' => 'List Notes', 'description' => 'List Notes in Zendesk Sell.', 'icon' => 'ph:list'],
            'zendesk_sell_list_pipelines' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellListPipelines', 'type' => 'read', 'name' => 'List Pipelines', 'description' => 'List Pipelines in Zendesk Sell.', 'icon' => 'ph:list'],
            'zendesk_sell_list_products' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellListProducts', 'type' => 'read', 'name' => 'List Products', 'description' => 'List Products in Zendesk Sell.', 'icon' => 'ph:list'],
            'zendesk_sell_list_stages' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellListStages', 'type' => 'read', 'name' => 'List Stages', 'description' => 'List Stages in Zendesk Sell.', 'icon' => 'ph:list'],
            'zendesk_sell_list_tasks' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellListTasks', 'type' => 'read', 'name' => 'List Tasks', 'description' => 'List Tasks in Zendesk Sell.', 'icon' => 'ph:list'],
            'zendesk_sell_list_users' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellListUsers', 'type' => 'read', 'name' => 'List Users', 'description' => 'List Users in Zendesk Sell.', 'icon' => 'ph:list'],
            'zendesk_sell_update_contact' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellUpdateContact', 'type' => 'write', 'name' => 'Update Contact', 'description' => 'Update Contact in Zendesk Sell.', 'icon' => 'ph:pencil-simple'],
            'zendesk_sell_update_deal' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellUpdateDeal', 'type' => 'write', 'name' => 'Update Deal', 'description' => 'Update Deal in Zendesk Sell.', 'icon' => 'ph:pencil-simple'],
            'zendesk_sell_update_deal_source' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellUpdateDealSource', 'type' => 'write', 'name' => 'Update Deal Source', 'description' => 'Update Deal Source in Zendesk Sell.', 'icon' => 'ph:pencil-simple'],
            'zendesk_sell_update_lead' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellUpdateLead', 'type' => 'write', 'name' => 'Update Lead', 'description' => 'Update Lead in Zendesk Sell.', 'icon' => 'ph:pencil-simple'],
            'zendesk_sell_update_lead_source' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellUpdateLeadSource', 'type' => 'write', 'name' => 'Update Lead Source', 'description' => 'Update Lead Source in Zendesk Sell.', 'icon' => 'ph:pencil-simple'],
            'zendesk_sell_update_loss_reason' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellUpdateLossReason', 'type' => 'write', 'name' => 'Update Loss Reason', 'description' => 'Update Loss Reason in Zendesk Sell.', 'icon' => 'ph:pencil-simple'],
            'zendesk_sell_update_note' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellUpdateNote', 'type' => 'write', 'name' => 'Update Note', 'description' => 'Update Note in Zendesk Sell.', 'icon' => 'ph:pencil-simple'],
            'zendesk_sell_update_product' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellUpdateProduct', 'type' => 'write', 'name' => 'Update Product', 'description' => 'Update Product in Zendesk Sell.', 'icon' => 'ph:pencil-simple'],
            'zendesk_sell_update_task' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellUpdateTask', 'type' => 'write', 'name' => 'Update Task', 'description' => 'Update Task in Zendesk Sell.', 'icon' => 'ph:pencil-simple'],
            'zendesk_sell_upsert_contact' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellUpsertContact', 'type' => 'write', 'name' => 'Upsert Contact', 'description' => 'Upsert Contact in Zendesk Sell.', 'icon' => 'ph:plus-circle'],
            'zendesk_sell_upsert_deal' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellUpsertDeal', 'type' => 'write', 'name' => 'Upsert Deal', 'description' => 'Upsert Deal in Zendesk Sell.', 'icon' => 'ph:plus-circle'],
            'zendesk_sell_upsert_lead' => ['class' => 'OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellUpsertLead', 'type' => 'write', 'name' => 'Upsert Lead', 'description' => 'Upsert Lead in Zendesk Sell.', 'icon' => 'ph:plus-circle'],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/zendesk-sell.md';
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.getbase.com'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally using account-specific credentials.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Context containing optional account.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the Zendesk Sell service for the default account or a named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): ZendeskSellService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new ZendeskSellService(
                accessToken: $creds->get('zendesk-sell', 'access_token', '', $account),
                baseUrl: $creds->get('zendesk-sell', 'url', 'https://api.getbase.com', $account),
            );
        }

        return app(ZendeskSellService::class);
    }
}
