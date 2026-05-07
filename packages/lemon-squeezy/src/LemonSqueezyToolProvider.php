<?php

namespace OpenCompany\Integrations\LemonSqueezy;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyApiDelete;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyApiGet;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyApiPatch;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyApiPost;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyCancelSubscription;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyCreateCheckout;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyCreateCustomer;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyCreateDiscount;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyCreateUsageRecord;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyCreateWebhook;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyDeleteDiscount;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyDeleteWebhook;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyGenerateOrderInvoice;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyGetCheckout;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyGetCurrentUser;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyGetCustomer;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyGetDiscount;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyGetDiscountRedemption;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyGetFile;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyGetLicenseKey;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyGetLicenseKeyInstance;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyGetOrder;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyGetOrderItem;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyGetPrice;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyGetProduct;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyGetStore;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyGetSubscription;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyGetSubscriptionInvoice;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyGetSubscriptionItem;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyGetUsageRecord;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyGetVariant;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyGetWebhook;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyListCheckouts;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyListCustomers;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyListDiscountRedemptions;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyListDiscounts;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyListFiles;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyListLicenseKeyInstances;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyListLicenseKeys;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyListOrderItems;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyListOrders;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyListPrices;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyListProducts;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyListStores;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyListSubscriptionInvoices;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyListSubscriptionItems;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyListSubscriptions;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyListUsageRecords;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyListVariants;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyListWebhooks;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyRefundOrder;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyUpdateCustomer;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyUpdateLicenseKey;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyUpdateSubscription;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyUpdateSubscriptionItem;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyUpdateWebhook;

/**
 * Registers Lemon Squeezy tools, metadata, credentials, and multi-account service resolution.
 */
class LemonSqueezyToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'notes' => ['API keys are account-scoped. Use store filters to avoid mixing test and production stores.'],
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

    public function appName(): string { return 'lemon-squeezy'; }

    public function appMeta(): array
    {
        return ['label' => 'Lemon Squeezy', 'description' => 'Digital commerce and subscriptions', 'icon' => 'ph:storefront', 'logo' => 'simple-icons:lemonsqueezy'];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Lemon Squeezy',
            'description' => 'Digital products, subscriptions, orders, customers, licenses, discounts, checkouts, and webhooks.',
            'icon' => 'ph:storefront',
            'logo' => 'simple-icons:lemonsqueezy',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://docs.lemonsqueezy.com/api',
        ];
    }

    public function configSchema(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'Enter your Lemon Squeezy API key', 'hint' => 'Generate an API key in Lemon Squeezy under Settings > API.', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://api.lemonsqueezy.com', 'hint' => 'Change only if using a custom endpoint.', 'default' => 'https://api.lemonsqueezy.com'],
        ];
    }

    /**
     * Test Lemon Squeezy credentials with the current user endpoint.
     *
     * @param  array<string, mixed>  $config  Credential configuration.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.lemonsqueezy.com'), '/');

        if ($apiKey === '') {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$apiKey,
                'Accept' => 'application/vnd.api+json',
                'Content-Type' => 'application/vnd.api+json',
            ])->timeout(10)->get($baseUrl.'/v1/users/me');

            if (!$response->successful()) {
                return ['success' => false, 'error' => "Authentication failed (HTTP {$response->status()}). Check your API key."];
            }

            $json = $response->json() ?? [];
            $userName = $json['data']['attributes']['name'] ?? 'Unknown';
            $userEmail = $json['data']['attributes']['email'] ?? '';

            return ['success' => true, 'message' => "Connected to Lemon Squeezy as {$userName}".($userEmail ? " ({$userEmail})" : '').'.'];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return ['api_key' => 'nullable|string', 'url' => 'nullable|url'];
    }

    public function tools(): array
    {
        return [
            'lemonsqueezy_list_stores' => $this->tool(LemonSqueezyListStores::class, 'read', 'List Stores', 'List stores.'),
            'lemonsqueezy_get_store' => $this->tool(LemonSqueezyGetStore::class, 'read', 'Get Store', 'Get one store.'),
            'lemonsqueezy_list_products' => $this->tool(LemonSqueezyListProducts::class, 'read', 'List Products', 'List products.'),
            'lemonsqueezy_get_product' => $this->tool(LemonSqueezyGetProduct::class, 'read', 'Get Product', 'Get one product.'),
            'lemonsqueezy_list_variants' => $this->tool(LemonSqueezyListVariants::class, 'read', 'List Variants', 'List variants.'),
            'lemonsqueezy_get_variant' => $this->tool(LemonSqueezyGetVariant::class, 'read', 'Get Variant', 'Get one variant.'),
            'lemonsqueezy_list_prices' => $this->tool(LemonSqueezyListPrices::class, 'read', 'List Prices', 'List prices.'),
            'lemonsqueezy_get_price' => $this->tool(LemonSqueezyGetPrice::class, 'read', 'Get Price', 'Get one price.'),
            'lemonsqueezy_list_files' => $this->tool(LemonSqueezyListFiles::class, 'read', 'List Files', 'List files.'),
            'lemonsqueezy_get_file' => $this->tool(LemonSqueezyGetFile::class, 'read', 'Get File', 'Get one file.'),
            'lemonsqueezy_list_customers' => $this->tool(LemonSqueezyListCustomers::class, 'read', 'List Customers', 'List customers.'),
            'lemonsqueezy_get_customer' => $this->tool(LemonSqueezyGetCustomer::class, 'read', 'Get Customer', 'Get one customer.'),
            'lemonsqueezy_create_customer' => $this->tool(LemonSqueezyCreateCustomer::class, 'write', 'Create Customer', 'Create a customer.'),
            'lemonsqueezy_update_customer' => $this->tool(LemonSqueezyUpdateCustomer::class, 'write', 'Update Customer', 'Update a customer.'),
            'lemonsqueezy_list_orders' => $this->tool(LemonSqueezyListOrders::class, 'read', 'List Orders', 'List orders.'),
            'lemonsqueezy_get_order' => $this->tool(LemonSqueezyGetOrder::class, 'read', 'Get Order', 'Get one order.'),
            'lemonsqueezy_generate_order_invoice' => $this->tool(LemonSqueezyGenerateOrderInvoice::class, 'write', 'Generate Order Invoice', 'Generate an order invoice.'),
            'lemonsqueezy_refund_order' => $this->tool(LemonSqueezyRefundOrder::class, 'write', 'Refund Order', 'Refund an order.'),
            'lemonsqueezy_list_order_items' => $this->tool(LemonSqueezyListOrderItems::class, 'read', 'List Order Items', 'List order items.'),
            'lemonsqueezy_get_order_item' => $this->tool(LemonSqueezyGetOrderItem::class, 'read', 'Get Order Item', 'Get one order item.'),
            'lemonsqueezy_list_subscriptions' => $this->tool(LemonSqueezyListSubscriptions::class, 'read', 'List Subscriptions', 'List subscriptions.'),
            'lemonsqueezy_get_subscription' => $this->tool(LemonSqueezyGetSubscription::class, 'read', 'Get Subscription', 'Get one subscription.'),
            'lemonsqueezy_update_subscription' => $this->tool(LemonSqueezyUpdateSubscription::class, 'write', 'Update Subscription', 'Update a subscription.'),
            'lemonsqueezy_cancel_subscription' => $this->tool(LemonSqueezyCancelSubscription::class, 'write', 'Cancel Subscription', 'Cancel a subscription.'),
            'lemonsqueezy_list_subscription_invoices' => $this->tool(LemonSqueezyListSubscriptionInvoices::class, 'read', 'List Subscription Invoices', 'List subscription invoices.'),
            'lemonsqueezy_get_subscription_invoice' => $this->tool(LemonSqueezyGetSubscriptionInvoice::class, 'read', 'Get Subscription Invoice', 'Get one subscription invoice.'),
            'lemonsqueezy_list_subscription_items' => $this->tool(LemonSqueezyListSubscriptionItems::class, 'read', 'List Subscription Items', 'List subscription items.'),
            'lemonsqueezy_get_subscription_item' => $this->tool(LemonSqueezyGetSubscriptionItem::class, 'read', 'Get Subscription Item', 'Get one subscription item.'),
            'lemonsqueezy_update_subscription_item' => $this->tool(LemonSqueezyUpdateSubscriptionItem::class, 'write', 'Update Subscription Item', 'Update a subscription item.'),
            'lemonsqueezy_list_usage_records' => $this->tool(LemonSqueezyListUsageRecords::class, 'read', 'List Usage Records', 'List usage records.'),
            'lemonsqueezy_get_usage_record' => $this->tool(LemonSqueezyGetUsageRecord::class, 'read', 'Get Usage Record', 'Get one usage record.'),
            'lemonsqueezy_create_usage_record' => $this->tool(LemonSqueezyCreateUsageRecord::class, 'write', 'Create Usage Record', 'Create a usage record.'),
            'lemonsqueezy_list_discounts' => $this->tool(LemonSqueezyListDiscounts::class, 'read', 'List Discounts', 'List discounts.'),
            'lemonsqueezy_get_discount' => $this->tool(LemonSqueezyGetDiscount::class, 'read', 'Get Discount', 'Get one discount.'),
            'lemonsqueezy_create_discount' => $this->tool(LemonSqueezyCreateDiscount::class, 'write', 'Create Discount', 'Create a discount.'),
            'lemonsqueezy_delete_discount' => $this->tool(LemonSqueezyDeleteDiscount::class, 'write', 'Delete Discount', 'Delete a discount.'),
            'lemonsqueezy_list_discount_redemptions' => $this->tool(LemonSqueezyListDiscountRedemptions::class, 'read', 'List Discount Redemptions', 'List discount redemptions.'),
            'lemonsqueezy_get_discount_redemption' => $this->tool(LemonSqueezyGetDiscountRedemption::class, 'read', 'Get Discount Redemption', 'Get one discount redemption.'),
            'lemonsqueezy_list_license_keys' => $this->tool(LemonSqueezyListLicenseKeys::class, 'read', 'List License Keys', 'List license keys.'),
            'lemonsqueezy_get_license_key' => $this->tool(LemonSqueezyGetLicenseKey::class, 'read', 'Get License Key', 'Get one license key.'),
            'lemonsqueezy_update_license_key' => $this->tool(LemonSqueezyUpdateLicenseKey::class, 'write', 'Update License Key', 'Update a license key.'),
            'lemonsqueezy_list_license_key_instances' => $this->tool(LemonSqueezyListLicenseKeyInstances::class, 'read', 'List License Key Instances', 'List license key instances.'),
            'lemonsqueezy_get_license_key_instance' => $this->tool(LemonSqueezyGetLicenseKeyInstance::class, 'read', 'Get License Key Instance', 'Get one license key instance.'),
            'lemonsqueezy_list_checkouts' => $this->tool(LemonSqueezyListCheckouts::class, 'read', 'List Checkouts', 'List checkouts.'),
            'lemonsqueezy_get_checkout' => $this->tool(LemonSqueezyGetCheckout::class, 'read', 'Get Checkout', 'Get one checkout.'),
            'lemonsqueezy_create_checkout' => $this->tool(LemonSqueezyCreateCheckout::class, 'write', 'Create Checkout', 'Create a checkout.'),
            'lemonsqueezy_list_webhooks' => $this->tool(LemonSqueezyListWebhooks::class, 'read', 'List Webhooks', 'List webhooks.'),
            'lemonsqueezy_get_webhook' => $this->tool(LemonSqueezyGetWebhook::class, 'read', 'Get Webhook', 'Get one webhook.'),
            'lemonsqueezy_create_webhook' => $this->tool(LemonSqueezyCreateWebhook::class, 'write', 'Create Webhook', 'Create a webhook.'),
            'lemonsqueezy_update_webhook' => $this->tool(LemonSqueezyUpdateWebhook::class, 'write', 'Update Webhook', 'Update a webhook.'),
            'lemonsqueezy_delete_webhook' => $this->tool(LemonSqueezyDeleteWebhook::class, 'write', 'Delete Webhook', 'Delete a webhook.'),
            'lemonsqueezy_get_current_user' => $this->tool(LemonSqueezyGetCurrentUser::class, 'read', 'Get Current User', 'Get current user.'),
            'lemonsqueezy_api_get' => $this->tool(LemonSqueezyApiGet::class, 'read', 'API GET', 'Call a relative API path with GET.'),
            'lemonsqueezy_api_post' => $this->tool(LemonSqueezyApiPost::class, 'write', 'API POST', 'Call a relative API path with POST.'),
            'lemonsqueezy_api_patch' => $this->tool(LemonSqueezyApiPatch::class, 'write', 'API PATCH', 'Call a relative API path with PATCH.'),
            'lemonsqueezy_api_delete' => $this->tool(LemonSqueezyApiDelete::class, 'write', 'API DELETE', 'Call a relative API path with DELETE.'),
        ];
    }

    public function luaDocsPath(): ?string { return __DIR__ . '/../lua-docs/lemon-squeezy.md'; }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.lemonsqueezy.com'],
        ];
    }

    public function isIntegration(): bool { return true; }

    /** @param class-string<Tool> $class @param array<string, mixed> $context */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /** @param array<string, mixed> $context */
    private function resolveService(array $context = []): LemonSqueezyService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new LemonSqueezyService(
                apiKey: $creds->get('lemon-squeezy', 'api_key', '', $account),
                baseUrl: $creds->get('lemon-squeezy', 'url', 'https://api.lemonsqueezy.com', $account),
            );
        }

        return app(LemonSqueezyService::class);
    }

    /** @param class-string<Tool> $class @return array<string, mixed> */
    private function tool(string $class, string $type, string $name, string $description): array
    {
        return ['class' => $class, 'type' => $type, 'name' => $name, 'description' => $description, 'icon' => $type === 'read' ? 'ph:storefront' : 'ph:pencil-simple'];
    }
}
