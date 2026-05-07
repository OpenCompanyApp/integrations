<?php

namespace OpenCompany\Integrations\Tapfiliate;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Tapfiliate\Tools\TapfiliateAddConversionCommission;
use OpenCompany\Integrations\Tapfiliate\Tools\TapfiliateCreateAffiliate;
use OpenCompany\Integrations\Tapfiliate\Tools\TapfiliateCreateConversion;
use OpenCompany\Integrations\Tapfiliate\Tools\TapfiliateCreateCustomer;
use OpenCompany\Integrations\Tapfiliate\Tools\TapfiliateDeleteAffiliate;
use OpenCompany\Integrations\Tapfiliate\Tools\TapfiliateGetAffiliate;
use OpenCompany\Integrations\Tapfiliate\Tools\TapfiliateGetCommission;
use OpenCompany\Integrations\Tapfiliate\Tools\TapfiliateGetConversion;
use OpenCompany\Integrations\Tapfiliate\Tools\TapfiliateGetCurrentUser;
use OpenCompany\Integrations\Tapfiliate\Tools\TapfiliateGetProgramAffiliate;
use OpenCompany\Integrations\Tapfiliate\Tools\TapfiliateListAffiliateGroups;
use OpenCompany\Integrations\Tapfiliate\Tools\TapfiliateListAffiliateNotes;
use OpenCompany\Integrations\Tapfiliate\Tools\TapfiliateListAffiliates;
use OpenCompany\Integrations\Tapfiliate\Tools\TapfiliateListCommissions;
use OpenCompany\Integrations\Tapfiliate\Tools\TapfiliateListConversions;
use OpenCompany\Integrations\Tapfiliate\Tools\TapfiliateListCustomers;
use OpenCompany\Integrations\Tapfiliate\Tools\TapfiliateListProgramCommissionTypes;
use OpenCompany\Integrations\Tapfiliate\Tools\TapfiliateListPrograms;
use OpenCompany\Integrations\Tapfiliate\Tools\TapfiliateSetAffiliateGroup;
use OpenCompany\Integrations\Tapfiliate\Tools\TapfiliateUpdateAffiliate;
use OpenCompany\Integrations\Tapfiliate\Tools\TapfiliateUpdateProgramAffiliate;

/**
 * Tool provider for the Tapfiliate integration.
 *
 * Exposes Tapfiliate API v1.6 resources for affiliates, conversions, commissions,
 * customers, programs, groups, and account verification.
 */
class TapfiliateToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'notes' => [],
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
        return 'tapfiliate';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Tapfiliate',
            'description' => 'Affiliate marketing and referral tracking',
            'icon' => 'ph:users-three',
            'logo' => 'simple-icons:tapfiliate',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Tapfiliate',
            'description' => 'Manage Tapfiliate affiliates, conversions, commissions, customers, and programs',
            'icon' => 'ph:users-three',
            'logo' => 'simple-icons:tapfiliate',
            'category' => 'analytics',
            'badge' => 'verified',
            'docs_url' => 'https://tapfiliate.com/docs/rest/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Tapfiliate API key',
                'hint' => 'Find your API key in Tapfiliate settings.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.tapfiliate.com/1.6',
                'hint' => 'Defaults to the Tapfiliate API v1.6 base URL.',
                'default' => 'https://api.tapfiliate.com/1.6',
            ],
        ];
    }

    /**
     * Test the connection to the Tapfiliate API.
     *
     * @param  array<string, mixed>  $config  Integration configuration
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.tapfiliate.com/1.6'), '/');

        if ($apiKey === '') {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'X-Api-Key' => $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/me/');

            if ($response->successful()) {
                $user = $response->json();
                $name = $user['first_name'] ?? $user['email'] ?? 'Tapfiliate';

                return [
                    'success' => true,
                    'message' => "Connected to Tapfiliate as {$name}.",
                ];
            }

            if ($response->status() === 401) {
                return ['success' => false, 'error' => 'Invalid API key.'];
            }

            return ['success' => false, 'error' => "Tapfiliate API returned HTTP {$response->status()}."];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'tapfiliate_get_current_user' => ['class' => TapfiliateGetCurrentUser::class, 'type' => 'read', 'name' => 'Get Current User', 'description' => 'Get the authenticated Tapfiliate profile.', 'icon' => 'ph:identification-card'],
            'tapfiliate_list_affiliates' => ['class' => TapfiliateListAffiliates::class, 'type' => 'read', 'name' => 'List Affiliates', 'description' => 'List affiliates with filters.', 'icon' => 'ph:users-three'],
            'tapfiliate_get_affiliate' => ['class' => TapfiliateGetAffiliate::class, 'type' => 'read', 'name' => 'Get Affiliate', 'description' => 'Get details for a specific affiliate.', 'icon' => 'ph:user'],
            'tapfiliate_create_affiliate' => ['class' => TapfiliateCreateAffiliate::class, 'type' => 'write', 'name' => 'Create Affiliate', 'description' => 'Create a Tapfiliate affiliate.', 'icon' => 'ph:user-plus'],
            'tapfiliate_update_affiliate' => ['class' => TapfiliateUpdateAffiliate::class, 'type' => 'write', 'name' => 'Update Affiliate', 'description' => 'Update a Tapfiliate affiliate.', 'icon' => 'ph:user-gear'],
            'tapfiliate_delete_affiliate' => ['class' => TapfiliateDeleteAffiliate::class, 'type' => 'write', 'name' => 'Delete Affiliate', 'description' => 'Delete a Tapfiliate affiliate.', 'icon' => 'ph:user-x'],
            'tapfiliate_set_affiliate_group' => ['class' => TapfiliateSetAffiliateGroup::class, 'type' => 'write', 'name' => 'Set Affiliate Group', 'description' => 'Assign an affiliate group.', 'icon' => 'ph:users-four'],
            'tapfiliate_list_affiliate_notes' => ['class' => TapfiliateListAffiliateNotes::class, 'type' => 'read', 'name' => 'List Affiliate Notes', 'description' => 'List affiliate notes.', 'icon' => 'ph:note'],
            'tapfiliate_list_affiliate_groups' => ['class' => TapfiliateListAffiliateGroups::class, 'type' => 'read', 'name' => 'List Affiliate Groups', 'description' => 'List affiliate groups.', 'icon' => 'ph:tree-structure'],
            'tapfiliate_list_conversions' => ['class' => TapfiliateListConversions::class, 'type' => 'read', 'name' => 'List Conversions', 'description' => 'List conversions with optional filters.', 'icon' => 'ph:currency-dollar'],
            'tapfiliate_get_conversion' => ['class' => TapfiliateGetConversion::class, 'type' => 'read', 'name' => 'Get Conversion', 'description' => 'Get a conversion by ID.', 'icon' => 'ph:receipt'],
            'tapfiliate_create_conversion' => ['class' => TapfiliateCreateConversion::class, 'type' => 'write', 'name' => 'Create Conversion', 'description' => 'Create a conversion.', 'icon' => 'ph:plus-circle'],
            'tapfiliate_add_conversion_commission' => ['class' => TapfiliateAddConversionCommission::class, 'type' => 'write', 'name' => 'Add Conversion Commission', 'description' => 'Add a commission line to a conversion.', 'icon' => 'ph:percent'],
            'tapfiliate_list_commissions' => ['class' => TapfiliateListCommissions::class, 'type' => 'read', 'name' => 'List Commissions', 'description' => 'List commissions with filters.', 'icon' => 'ph:coins'],
            'tapfiliate_get_commission' => ['class' => TapfiliateGetCommission::class, 'type' => 'read', 'name' => 'Get Commission', 'description' => 'Get a commission by ID.', 'icon' => 'ph:coin'],
            'tapfiliate_list_customers' => ['class' => TapfiliateListCustomers::class, 'type' => 'read', 'name' => 'List Customers', 'description' => 'List tracked customers.', 'icon' => 'ph:address-book'],
            'tapfiliate_create_customer' => ['class' => TapfiliateCreateCustomer::class, 'type' => 'write', 'name' => 'Create Customer', 'description' => 'Create a tracked customer.', 'icon' => 'ph:user-list'],
            'tapfiliate_list_programs' => ['class' => TapfiliateListPrograms::class, 'type' => 'read', 'name' => 'List Programs', 'description' => 'List affiliate programs.', 'icon' => 'ph:folders'],
            'tapfiliate_get_program_affiliate' => ['class' => TapfiliateGetProgramAffiliate::class, 'type' => 'read', 'name' => 'Get Program Affiliate', 'description' => 'Get a program affiliate record.', 'icon' => 'ph:identification-badge'],
            'tapfiliate_update_program_affiliate' => ['class' => TapfiliateUpdateProgramAffiliate::class, 'type' => 'write', 'name' => 'Update Program Affiliate', 'description' => 'Update a program affiliate record.', 'icon' => 'ph:pencil-simple'],
            'tapfiliate_list_program_commission_types' => ['class' => TapfiliateListProgramCommissionTypes::class, 'type' => 'read', 'name' => 'List Program Commission Types', 'description' => 'List commission types for a program.', 'icon' => 'ph:list-checks'],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/tapfiliate.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.tapfiliate.com/1.6'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally with account-specific credentials.
     *
     * @param  string  $class  Tool class name
     * @param  array<string, mixed>  $context  Optional account context
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the Tapfiliate service for default or named-account credentials.
     *
     * @param  array<string, mixed>  $context  Optional account context
     */
    private function resolveService(array $context = []): TapfiliateService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new TapfiliateService(
                apiKey: $creds->get('tapfiliate', 'api_key', '', $account),
                baseUrl: $creds->get('tapfiliate', 'url', 'https://api.tapfiliate.com/1.6', $account),
            );
        }

        return app(TapfiliateService::class);
    }
}
