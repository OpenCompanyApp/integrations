<?php

namespace OpenCompany\Integrations\Chargebee;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Chargebee\Tools\ChargebeeCancelSubscription;
use OpenCompany\Integrations\Chargebee\Tools\ChargebeeCreateCustomer;
use OpenCompany\Integrations\Chargebee\Tools\ChargebeeCreateSubscription;
use OpenCompany\Integrations\Chargebee\Tools\ChargebeeGetCurrentUser;
use OpenCompany\Integrations\Chargebee\Tools\ChargebeeGetCustomer;
use OpenCompany\Integrations\Chargebee\Tools\ChargebeeGetInvoice;
use OpenCompany\Integrations\Chargebee\Tools\ChargebeeGetSubscription;
use OpenCompany\Integrations\Chargebee\Tools\ChargebeeListCustomers;
use OpenCompany\Integrations\Chargebee\Tools\ChargebeeListInvoices;
use OpenCompany\Integrations\Chargebee\Tools\ChargebeeListPlans;
use OpenCompany\Integrations\Chargebee\Tools\ChargebeeListSubscriptions;
use OpenCompany\Integrations\Chargebee\Tools\ChargebeeUpdateSubscription;

/**
 * Tool provider for the Chargebee billing and subscription management integration.
 *
 * Registers all Chargebee tools with the ToolProviderRegistry and provides
 * multi-account support via createTool(). Implements ConfigurableIntegration
 * for the integration settings UI.
 */
class ChargebeeToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * {@inheritdoc}
     */
    public function appName(): string
    {
        return 'chargebee';
    }

    /**
     * {@inheritdoc}
     */
    public function appMeta(): array
    {
        return [
            'label' => 'subscriptions, customers, invoices, plans',
            'description' => 'Billing & subscription management',
            'icon' => 'ph:credit-card',
            'logo' => 'simple-icons:chargebee',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Chargebee',
            'description' => 'Subscription billing and revenue management',
            'icon' => 'ph:credit-card',
            'logo' => 'simple-icons:chargebee',
            'category' => 'billing',
            'badge' => 'verified',
            'docs_url' => 'https://apidocs.chargebee.com/docs/api',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Chargebee API key',
                'hint' => 'Find your API key in Chargebee under Settings > API Keys',
                'required' => true,
            ],
            [
                'key' => 'site_name',
                'type' => 'string',
                'label' => 'Site Name',
                'placeholder' => 'your-site',
                'hint' => 'Your Chargebee site name (the subdomain in <code>your-site.chargebee.com</code>)',
                'required' => true,
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $siteName = $config['site_name'] ?? '';

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        if (empty($siteName)) {
            return ['success' => false, 'error' => 'No site name provided'];
        }

        try {
            $response = Http::withBasicAuth($apiKey, '')
                ->timeout(10)
                ->get("https://{$siteName}.chargebee.com/api/v2/site");

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => "Connected to Chargebee site \"{$siteName}\".",
                ];
            }

            return [
                'success' => false,
                'error' => "Authentication failed (HTTP {$response->status()}). Check your API key and site name.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * {@inheritdoc}
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'site_name' => 'nullable|string',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function tools(): array
    {
        return [
            'chargebee_list_subscriptions' => [
                'class' => ChargebeeListSubscriptions::class,
                'type' => 'read',
                'name' => 'List Subscriptions',
                'description' => 'List subscriptions with optional filtering by status and plan.',
                'icon' => 'ph:list',
            ],
            'chargebee_get_subscription' => [
                'class' => ChargebeeGetSubscription::class,
                'type' => 'read',
                'name' => 'Get Subscription',
                'description' => 'Retrieve details of a single subscription.',
                'icon' => 'ph:eye',
            ],
            'chargebee_create_subscription' => [
                'class' => ChargebeeCreateSubscription::class,
                'type' => 'write',
                'name' => 'Create Subscription',
                'description' => 'Create a new subscription for a customer.',
                'icon' => 'ph:plus',
            ],
            'chargebee_update_subscription' => [
                'class' => ChargebeeUpdateSubscription::class,
                'type' => 'write',
                'name' => 'Update Subscription',
                'description' => 'Update an existing subscription (change plan, add addons).',
                'icon' => 'ph:pencil',
            ],
            'chargebee_cancel_subscription' => [
                'class' => ChargebeeCancelSubscription::class,
                'type' => 'write',
                'name' => 'Cancel Subscription',
                'description' => 'Cancel an active subscription.',
                'icon' => 'ph:x-circle',
            ],
            'chargebee_list_customers' => [
                'class' => ChargebeeListCustomers::class,
                'type' => 'read',
                'name' => 'List Customers',
                'description' => 'List customers with pagination.',
                'icon' => 'ph:users',
            ],
            'chargebee_get_customer' => [
                'class' => ChargebeeGetCustomer::class,
                'type' => 'read',
                'name' => 'Get Customer',
                'description' => 'Retrieve details of a single customer.',
                'icon' => 'ph:user',
            ],
            'chargebee_create_customer' => [
                'class' => ChargebeeCreateCustomer::class,
                'type' => 'write',
                'name' => 'Create Customer',
                'description' => 'Create a new customer record.',
                'icon' => 'ph:user-plus',
            ],
            'chargebee_list_invoices' => [
                'class' => ChargebeeListInvoices::class,
                'type' => 'read',
                'name' => 'List Invoices',
                'description' => 'List invoices with optional filtering by status and date.',
                'icon' => 'ph:file-text',
            ],
            'chargebee_get_invoice' => [
                'class' => ChargebeeGetInvoice::class,
                'type' => 'read',
                'name' => 'Get Invoice',
                'description' => 'Retrieve details of a single invoice.',
                'icon' => 'ph:file',
            ],
            'chargebee_list_plans' => [
                'class' => ChargebeeListPlans::class,
                'type' => 'read',
                'name' => 'List Plans',
                'description' => 'List available billing plans.',
                'icon' => 'ph:tag',
            ],
            'chargebee_get_current_user' => [
                'class' => ChargebeeGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Site Info',
                'description' => 'Verify site access and retrieve site information.',
                'icon' => 'ph:info',
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/chargebee.md';
    }

    /**
     * {@inheritdoc}
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'site_name', 'type' => 'string', 'label' => 'Site Name', 'required' => true],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally resolved for a specific account.
     *
     * When an account context is provided, credentials are resolved per-account
     * to support multi-account setups. Otherwise, the default service is used.
     *
     * @param  class-string<Tool>  $class    The tool class to instantiate.
     * @param  array<string, mixed> $context  Context containing optional 'account' key.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new ChargebeeService(
                apiKey: $creds->get('chargebee', 'api_key', '', $account),
                siteName: $creds->get('chargebee', 'site_name', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(ChargebeeService::class));
    }
}
