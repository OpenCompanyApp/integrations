<?php

namespace OpenCompany\Integrations\Gumroad;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use Throwable;

/**
 * Provides Gumroad API tools, metadata, configuration, and connection checks.
 */
class GumroadToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'notes' => ['Gumroad API v2 uses OAuth bearer tokens.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token', 'runtime_mode' => 'normal'],
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
        return 'gumroad';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Gumroad',
            'description' => 'Creator commerce operations',
            'icon' => 'ph:storefront',
            'logo' => 'simple-icons:gumroad',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Gumroad',
            'description' => 'Manage Gumroad products, sales, subscribers, offer codes, licenses, and resource subscriptions.',
            'icon' => 'ph:storefront',
            'logo' => 'simple-icons:gumroad',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://help.gumroad.com/article/280-gumroad-api',
        ];
    }

    public function configSchema(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'placeholder' => 'Gumroad OAuth access token', 'hint' => 'Generate an access token in Gumroad settings.', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://api.gumroad.com/v2', 'hint' => 'Use the default Gumroad API URL unless testing with a mock server.', 'required' => false, 'default' => 'https://api.gumroad.com/v2'],
        ];
    }

    /**
     * Verify Gumroad credentials with a lightweight user request.
     *
     * @param  array<string, mixed>  $config  Access token and optional API URL.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = (string) ($config['access_token'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.gumroad.com/v2'), '/');

        if ($accessToken === '') {
            return ['success' => false, 'error' => 'Access token is required.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/user');

            if ($response->successful()) {
                $json = $response->json() ?? [];

                return ['success' => true, 'message' => 'Connected to Gumroad API as ' . ($json['user']['name'] ?? 'unknown') . '.'];
            }

            $error = $response->json('error', $response->body());

            return ['success' => false, 'error' => 'Gumroad API error: ' . (is_string($error) ? $error : json_encode($error))];
        } catch (Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'gumroad_api_get' => [
                'class' => 'OpenCompany\\Integrations\\Gumroad\\Tools\\GumroadApiGet',
                'type' => 'read',
                'name' => 'API GET',
                'description' => 'Call any Gumroad API v2 GET endpoint path.',
                'icon' => 'ph:brackets-curly',
            ],
            'gumroad_api_post' => [
                'class' => 'OpenCompany\\Integrations\\Gumroad\\Tools\\GumroadApiPost',
                'type' => 'write',
                'name' => 'API POST',
                'description' => 'Call any Gumroad API v2 POST endpoint path.',
                'icon' => 'ph:brackets-curly',
            ],
            'gumroad_api_put' => [
                'class' => 'OpenCompany\\Integrations\\Gumroad\\Tools\\GumroadApiPut',
                'type' => 'write',
                'name' => 'API PUT',
                'description' => 'Call any Gumroad API v2 PUT endpoint path.',
                'icon' => 'ph:brackets-curly',
            ],
            'gumroad_api_delete' => [
                'class' => 'OpenCompany\\Integrations\\Gumroad\\Tools\\GumroadApiDelete',
                'type' => 'write',
                'name' => 'API DELETE',
                'description' => 'Call any Gumroad API v2 DELETE endpoint path.',
                'icon' => 'ph:brackets-curly',
            ],
            'gumroad_get_current_user' => [
                'class' => 'OpenCompany\\Integrations\\Gumroad\\Tools\\GumroadGetCurrentUser',
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated Gumroad user profile.',
                'icon' => 'ph:user-circle',
            ],
            'gumroad_list_products' => [
                'class' => 'OpenCompany\\Integrations\\Gumroad\\Tools\\GumroadListProducts',
                'type' => 'read',
                'name' => 'List Products',
                'description' => 'List all Gumroad products for the authenticated account.',
                'icon' => 'ph:package',
            ],
            'gumroad_get_product' => [
                'class' => 'OpenCompany\\Integrations\\Gumroad\\Tools\\GumroadGetProduct',
                'type' => 'read',
                'name' => 'Get Product',
                'description' => 'Get one Gumroad product by ID.',
                'icon' => 'ph:package',
            ],
            'gumroad_list_product_custom_fields' => [
                'class' => 'OpenCompany\\Integrations\\Gumroad\\Tools\\GumroadListProductCustomFields',
                'type' => 'read',
                'name' => 'List Product Custom Fields',
                'description' => 'List custom fields for a product.',
                'icon' => 'ph:list-plus',
            ],
            'gumroad_list_product_variants' => [
                'class' => 'OpenCompany\\Integrations\\Gumroad\\Tools\\GumroadListProductVariants',
                'type' => 'read',
                'name' => 'List Product Variants',
                'description' => 'List variants for a product.',
                'icon' => 'ph:git-branch',
            ],
            'gumroad_list_product_offer_codes' => [
                'class' => 'OpenCompany\\Integrations\\Gumroad\\Tools\\GumroadListProductOfferCodes',
                'type' => 'read',
                'name' => 'List Product Offer Codes',
                'description' => 'List offer codes for a product.',
                'icon' => 'ph:tag',
            ],
            'gumroad_create_product_offer_code' => [
                'class' => 'OpenCompany\\Integrations\\Gumroad\\Tools\\GumroadCreateProductOfferCode',
                'type' => 'write',
                'name' => 'Create Product Offer Code',
                'description' => 'Create an offer code for a product.',
                'icon' => 'ph:tag',
            ],
            'gumroad_delete_product_offer_code' => [
                'class' => 'OpenCompany\\Integrations\\Gumroad\\Tools\\GumroadDeleteProductOfferCode',
                'type' => 'write',
                'name' => 'Delete Product Offer Code',
                'description' => 'Delete an offer code for a product.',
                'icon' => 'ph:trash',
            ],
            'gumroad_list_sales' => [
                'class' => 'OpenCompany\\Integrations\\Gumroad\\Tools\\GumroadListSales',
                'type' => 'read',
                'name' => 'List Sales',
                'description' => 'List successful sales with optional filters.',
                'icon' => 'ph:receipt',
            ],
            'gumroad_get_sale' => [
                'class' => 'OpenCompany\\Integrations\\Gumroad\\Tools\\GumroadGetSale',
                'type' => 'read',
                'name' => 'Get Sale',
                'description' => 'Get one sale by ID.',
                'icon' => 'ph:receipt',
            ],
            'gumroad_mark_sale_as_shipped' => [
                'class' => 'OpenCompany\\Integrations\\Gumroad\\Tools\\GumroadMarkSaleAsShipped',
                'type' => 'write',
                'name' => 'Mark Sale As Shipped',
                'description' => 'Mark a physical sale as shipped.',
                'icon' => 'ph:truck',
            ],
            'gumroad_refund_sale' => [
                'class' => 'OpenCompany\\Integrations\\Gumroad\\Tools\\GumroadRefundSale',
                'type' => 'write',
                'name' => 'Refund Sale',
                'description' => 'Refund a sale.',
                'icon' => 'ph:receipt-x',
            ],
            'gumroad_list_subscribers' => [
                'class' => 'OpenCompany\\Integrations\\Gumroad\\Tools\\GumroadListSubscribers',
                'type' => 'read',
                'name' => 'List Subscribers',
                'description' => 'List subscribers, optionally filtered by product.',
                'icon' => 'ph:users',
            ],
            'gumroad_get_subscriber' => [
                'class' => 'OpenCompany\\Integrations\\Gumroad\\Tools\\GumroadGetSubscriber',
                'type' => 'read',
                'name' => 'Get Subscriber',
                'description' => 'Get one subscriber by ID.',
                'icon' => 'ph:user',
            ],
            'gumroad_list_product_subscribers' => [
                'class' => 'OpenCompany\\Integrations\\Gumroad\\Tools\\GumroadListProductSubscribers',
                'type' => 'read',
                'name' => 'List Product Subscribers',
                'description' => 'List subscribers for a specific product.',
                'icon' => 'ph:users',
            ],
            'gumroad_list_offers' => [
                'class' => 'OpenCompany\\Integrations\\Gumroad\\Tools\\GumroadListOffers',
                'type' => 'read',
                'name' => 'List Offers',
                'description' => 'List account-level offers when available.',
                'icon' => 'ph:tag',
            ],
            'gumroad_verify_license' => [
                'class' => 'OpenCompany\\Integrations\\Gumroad\\Tools\\GumroadVerifyLicense',
                'type' => 'write',
                'name' => 'Verify License',
                'description' => 'Verify a Gumroad license key.',
                'icon' => 'ph:key',
            ],
            'gumroad_enable_license' => [
                'class' => 'OpenCompany\\Integrations\\Gumroad\\Tools\\GumroadEnableLicense',
                'type' => 'write',
                'name' => 'Enable License',
                'description' => 'Enable a Gumroad license key.',
                'icon' => 'ph:key',
            ],
            'gumroad_disable_license' => [
                'class' => 'OpenCompany\\Integrations\\Gumroad\\Tools\\GumroadDisableLicense',
                'type' => 'write',
                'name' => 'Disable License',
                'description' => 'Disable a Gumroad license key.',
                'icon' => 'ph:key',
            ],
            'gumroad_decrement_license_uses' => [
                'class' => 'OpenCompany\\Integrations\\Gumroad\\Tools\\GumroadDecrementLicenseUses',
                'type' => 'write',
                'name' => 'Decrement License Uses',
                'description' => 'Decrement the uses count for a Gumroad license key.',
                'icon' => 'ph:key',
            ],
            'gumroad_list_resource_subscriptions' => [
                'class' => 'OpenCompany\\Integrations\\Gumroad\\Tools\\GumroadListResourceSubscriptions',
                'type' => 'read',
                'name' => 'List Resource Subscriptions',
                'description' => 'List webhook resource subscriptions by resource name.',
                'icon' => 'ph:webhooks-logo',
            ],
            'gumroad_create_resource_subscription' => [
                'class' => 'OpenCompany\\Integrations\\Gumroad\\Tools\\GumroadCreateResourceSubscription',
                'type' => 'write',
                'name' => 'Create Resource Subscription',
                'description' => 'Subscribe a URL to Gumroad resource notifications.',
                'icon' => 'ph:webhooks-logo',
            ],
            'gumroad_delete_resource_subscription' => [
                'class' => 'OpenCompany\\Integrations\\Gumroad\\Tools\\GumroadDeleteResourceSubscription',
                'type' => 'write',
                'name' => 'Delete Resource Subscription',
                'description' => 'Delete a Gumroad resource subscription.',
                'icon' => 'ph:trash',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/gumroad.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.gumroad.com/v2'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve a Gumroad service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Optional host runtime context.
     */
    private function resolveService(array $context = []): GumroadService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new GumroadService(
                accessToken: (string) $creds->get('gumroad', 'access_token', '', $account),
                baseUrl: (string) $creds->get('gumroad', 'url', 'https://api.gumroad.com/v2', $account),
            );
        }

        return app(GumroadService::class);
    }
}