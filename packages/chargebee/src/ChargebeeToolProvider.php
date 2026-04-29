<?php

namespace OpenCompany\Integrations\Chargebee;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Chargebee\Tools\ChargebeeGetCurrentUser;
use OpenCompany\Integrations\Chargebee\Tools\ChargebeeGetCustomer;
use OpenCompany\Integrations\Chargebee\Tools\ChargebeeGetInvoice;
use OpenCompany\Integrations\Chargebee\Tools\ChargebeeGetSubscription;
use OpenCompany\Integrations\Chargebee\Tools\ChargebeeListCustomers;
use OpenCompany\Integrations\Chargebee\Tools\ChargebeeListInvoices;
use OpenCompany\Integrations\Chargebee\Tools\ChargebeeListSubscriptions;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class ChargebeeToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'label' => 'Chargebee',
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
            'category' => 'payments',
            'badge' => 'verified',
            'docs_url' => 'https://apidocs.chargebee.com/docs/api',
        ];
    }/**
     * {@inheritdoc}
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Chargebee API access token',
                'hint' => 'Find your API key in Chargebee under Settings > Configure Chargebee > API Keys',
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
        $accessToken = $config['access_token'] ?? '';
        $siteName = $config['site_name'] ?? '';

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        if (empty($siteName)) {
            return ['success' => false, 'error' => 'No site name provided'];
        }

        try {
            $baseUrl = "https://{$siteName}.chargebee.com/api/v2";
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => "Connected to Chargebee site \"{$siteName}\".",
                ];
            }

            return [
                'success' => false,
                'error' => "Authentication failed (HTTP {$response->status()}). Check your access token and site name.",
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
            'access_token' => 'nullable|string',
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
                'description' => 'List subscriptions with optional filtering by state.',
                'icon' => 'ph:list',
            ],
            'chargebee_get_subscription' => [
                'class' => ChargebeeGetSubscription::class,
                'type' => 'read',
                'name' => 'Get Subscription',
                'description' => 'Retrieve details of a single subscription.',
                'icon' => 'ph:eye',
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
            'chargebee_list_invoices' => [
                'class' => ChargebeeListInvoices::class,
                'type' => 'read',
                'name' => 'List Invoices',
                'description' => 'List invoices with optional filtering by status.',
                'icon' => 'ph:file-text',
            ],
            'chargebee_get_invoice' => [
                'class' => ChargebeeGetInvoice::class,
                'type' => 'read',
                'name' => 'Get Invoice',
                'description' => 'Retrieve details of a single invoice.',
                'icon' => 'ph:file',
            ],
            'chargebee_get_current_user' => [
                'class' => ChargebeeGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Retrieve the current authenticated user information.',
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
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
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
    {        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new ChargebeeService(
                accessToken: $creds->get('chargebee', 'access_token', '', $account),
                siteName: $creds->get('chargebee', 'site_name', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(ChargebeeService::class));
    }
}
