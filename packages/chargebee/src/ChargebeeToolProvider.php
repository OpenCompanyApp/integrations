<?php

namespace OpenCompany\Integrations\Chargebee;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Chargebee\Tools\ChargebeeGetCurrentUser;
use OpenCompany\Integrations\Chargebee\Tools\ChargebeeGetCustomer;
use OpenCompany\Integrations\Chargebee\Tools\ChargebeeGetInvoice;
use OpenCompany\Integrations\Chargebee\Tools\ChargebeeGetSubscription;
use OpenCompany\Integrations\Chargebee\Tools\ChargebeeListCustomers;
use OpenCompany\Integrations\Chargebee\Tools\ChargebeeListInvoices;
use OpenCompany\Integrations\Chargebee\Tools\ChargebeeListSubscriptions;

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
                'strategy' => 'basic_auth',
                'legacy_auth_type' => 'api_key',
                'credential_mode' => 'stored_token',
                'setup_flows' => ['manual_token'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['access_token'],
                'notes' => ['Chargebee uses the API key as the HTTP Basic Auth username with an empty password.'],
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
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://api-static-site.chargebee.com/docs/api',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Chargebee API key',
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
                'Accept' => 'application/json',
            ])->withBasicAuth($accessToken, '')->timeout(10)->get($baseUrl . '/subscriptions', ['limit' => 1]);

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => "Connected to Chargebee site \"{$siteName}\".",
                ];
            }

            $json = $response->json();
            $error = $json['message'] ?? $json['error_msg'] ?? $json['api_error_code'] ?? "HTTP {$response->status()}";

            return [
                'success' => false,
                'error' => is_string($error) ? $error : json_encode($error),
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
            'chargebee_cancel_subscription_for_items' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeCancelSubscriptionForItems',
                'type' => 'write',
                'name' => 'Cancel Subscription For Items',
                'description' => 'Cancel a subscription with Product Catalog 2.0 item semantics.',
                'icon' => 'ph:arrows-clockwise',
            ],
            'chargebee_checkout_existing_for_items' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeCheckoutExistingForItems',
                'type' => 'write',
                'name' => 'Checkout Existing For Items',
                'description' => 'Create a hosted checkout page for an existing item-price subscription.',
                'icon' => 'ph:browser',
            ],
            'chargebee_checkout_new_for_items' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeCheckoutNewForItems',
                'type' => 'write',
                'name' => 'Checkout New For Items',
                'description' => 'Create a hosted checkout page for a new item-price subscription.',
                'icon' => 'ph:browser',
            ],
            'chargebee_close_invoice' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeCloseInvoice',
                'type' => 'write',
                'name' => 'Close Invoice',
                'description' => 'Close a pending Chargebee invoice.',
                'icon' => 'ph:file-text',
            ],
            'chargebee_collect_invoice_payment' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeCollectInvoicePayment',
                'type' => 'write',
                'name' => 'Collect Invoice Payment',
                'description' => 'Collect payment for an invoice.',
                'icon' => 'ph:file-text',
            ],
            'chargebee_collect_now_hosted_page' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeCollectNowHostedPage',
                'type' => 'write',
                'name' => 'Collect Now Hosted Page',
                'description' => 'Create a hosted page to collect unpaid invoices.',
                'icon' => 'ph:browser',
            ],
            'chargebee_create_coupon' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeCreateCoupon',
                'type' => 'write',
                'name' => 'Create Coupon',
                'description' => 'Create a Chargebee coupon.',
                'icon' => 'ph:ticket',
            ],
            'chargebee_create_credit_note' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeCreateCreditNote',
                'type' => 'write',
                'name' => 'Create Credit Note',
                'description' => 'Create a credit note for an invoice.',
                'icon' => 'ph:receipt',
            ],
            'chargebee_create_customer' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeCreateCustomer',
                'type' => 'write',
                'name' => 'Create Customer',
                'description' => 'Create a Chargebee customer.',
                'icon' => 'ph:user',
            ],
            'chargebee_create_invoice_for_charge_items_and_charges' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeCreateInvoiceForChargeItemsAndCharges',
                'type' => 'write',
                'name' => 'Create Invoice For Charge Items And Charges',
                'description' => 'Create a non-recurring invoice for charge items and ad hoc charges.',
                'icon' => 'ph:file-text',
            ],
            'chargebee_create_item' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeCreateItem',
                'type' => 'write',
                'name' => 'Create Item',
                'description' => 'Create a Chargebee item.',
                'icon' => 'ph:package',
            ],
            'chargebee_create_item_price' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeCreateItemPrice',
                'type' => 'write',
                'name' => 'Create Item Price',
                'description' => 'Create a Chargebee item price.',
                'icon' => 'ph:tag',
            ],
            'chargebee_create_payment_source' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeCreatePaymentSource',
                'type' => 'write',
                'name' => 'Create Payment Source',
                'description' => 'Create a payment source for a customer.',
                'icon' => 'ph:bank',
            ],
            'chargebee_create_subscription_for_customer' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeCreateSubscriptionForCustomer',
                'type' => 'write',
                'name' => 'Create Subscription For Customer',
                'description' => 'Create a subscription for an existing customer with item prices.',
                'icon' => 'ph:arrows-clockwise',
            ],
            'chargebee_create_subscription_for_items' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeCreateSubscriptionForItems',
                'type' => 'write',
                'name' => 'Create Subscription For Items',
                'description' => 'Create a subscription with Product Catalog 2.0 item prices.',
                'icon' => 'ph:arrows-clockwise',
            ],
            'chargebee_delete_coupon' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeDeleteCoupon',
                'type' => 'write',
                'name' => 'Delete Coupon',
                'description' => 'Delete or archive a Chargebee coupon by ID.',
                'icon' => 'ph:ticket',
            ],
            'chargebee_delete_credit_note' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeDeleteCreditNote',
                'type' => 'write',
                'name' => 'Delete Credit Note',
                'description' => 'Delete a Chargebee credit note.',
                'icon' => 'ph:receipt',
            ],
            'chargebee_delete_customer' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeDeleteCustomer',
                'type' => 'write',
                'name' => 'Delete Customer',
                'description' => 'Delete or archive a Chargebee customer by ID.',
                'icon' => 'ph:user',
            ],
            'chargebee_delete_invoice' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeDeleteInvoice',
                'type' => 'write',
                'name' => 'Delete Invoice',
                'description' => 'Delete a Chargebee invoice.',
                'icon' => 'ph:file-text',
            ],
            'chargebee_delete_item' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeDeleteItem',
                'type' => 'write',
                'name' => 'Delete Item',
                'description' => 'Delete or archive a Chargebee item by ID.',
                'icon' => 'ph:package',
            ],
            'chargebee_delete_item_price' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeDeleteItemPrice',
                'type' => 'write',
                'name' => 'Delete Item Price',
                'description' => 'Delete or archive a Chargebee item price by ID.',
                'icon' => 'ph:tag',
            ],
            'chargebee_delete_payment_source' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeDeletePaymentSource',
                'type' => 'write',
                'name' => 'Delete Payment Source',
                'description' => 'Delete a payment source.',
                'icon' => 'ph:bank',
            ],
            'chargebee_delete_subscription' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeDeleteSubscription',
                'type' => 'write',
                'name' => 'Delete Subscription',
                'description' => 'Delete a Chargebee subscription.',
                'icon' => 'ph:arrows-clockwise',
            ],
            'chargebee_estimate_cancel_subscription_for_items' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeEstimateCancelSubscriptionForItems',
                'type' => 'write',
                'name' => 'Estimate Cancel Subscription For Items',
                'description' => 'Estimate cancelling a subscription.',
                'icon' => 'ph:arrows-clockwise',
            ],
            'chargebee_estimate_create_invoice_for_items' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeEstimateCreateInvoiceForItems',
                'type' => 'write',
                'name' => 'Estimate Create Invoice For Items',
                'description' => 'Estimate creating an invoice for item prices and charges.',
                'icon' => 'ph:file-text',
            ],
            'chargebee_estimate_create_subscription_for_customer' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeEstimateCreateSubscriptionForCustomer',
                'type' => 'write',
                'name' => 'Estimate Create Subscription For Customer',
                'description' => 'Estimate creating a subscription for an existing customer.',
                'icon' => 'ph:arrows-clockwise',
            ],
            'chargebee_estimate_create_subscription_for_items' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeEstimateCreateSubscriptionForItems',
                'type' => 'write',
                'name' => 'Estimate Create Subscription For Items',
                'description' => 'Estimate creating a Product Catalog 2.0 subscription.',
                'icon' => 'ph:arrows-clockwise',
            ],
            'chargebee_estimate_renew_subscription' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeEstimateRenewSubscription',
                'type' => 'read',
                'name' => 'Estimate Renew Subscription',
                'description' => 'Estimate renewing a subscription.',
                'icon' => 'ph:arrows-clockwise',
            ],
            'chargebee_estimate_update_subscription_for_items' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeEstimateUpdateSubscriptionForItems',
                'type' => 'write',
                'name' => 'Estimate Update Subscription For Items',
                'description' => 'Estimate updating a Product Catalog 2.0 subscription.',
                'icon' => 'ph:arrows-clockwise',
            ],
            'chargebee_get_attached_item' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeGetAttachedItem',
                'type' => 'read',
                'name' => 'Get Attached Item',
                'description' => 'Retrieve a Chargebee attached item by ID.',
                'icon' => 'ph:package',
            ],
            'chargebee_get_business_entity' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeGetBusinessEntity',
                'type' => 'read',
                'name' => 'Get Business Entity',
                'description' => 'Retrieve a Chargebee business entity by ID.',
                'icon' => 'ph:database',
            ],
            'chargebee_get_coupon' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeGetCoupon',
                'type' => 'read',
                'name' => 'Get Coupon',
                'description' => 'Retrieve a Chargebee coupon by ID.',
                'icon' => 'ph:ticket',
            ],
            'chargebee_get_credit_note' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeGetCreditNote',
                'type' => 'read',
                'name' => 'Get Credit Note',
                'description' => 'Retrieve a Chargebee credit note by ID.',
                'icon' => 'ph:receipt',
            ],
            'chargebee_get_credit_note_pdf' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeGetCreditNotePdf',
                'type' => 'read',
                'name' => 'Get Credit Note Pdf',
                'description' => 'Retrieve credit note PDF metadata and download URL.',
                'icon' => 'ph:receipt',
            ],
            'chargebee_get_current_user' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeGetCurrentUser',
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Verify Chargebee API connectivity with a lightweight subscriptions request. Use this to confirm credentials and site name are working.',
                'icon' => 'ph:database',
            ],
            'chargebee_get_customer' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeGetCustomer',
                'type' => 'read',
                'name' => 'Get Customer',
                'description' => 'Retrieve detailed information about a specific Chargebee customer by their ID, including contact details, billing address, and payment method.',
                'icon' => 'ph:user',
            ],
            'chargebee_get_event' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeGetEvent',
                'type' => 'read',
                'name' => 'Get Event',
                'description' => 'Retrieve a Chargebee event by ID.',
                'icon' => 'ph:bell',
            ],
            'chargebee_get_hosted_page' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeGetHostedPage',
                'type' => 'read',
                'name' => 'Get Hosted Page',
                'description' => 'Retrieve a Chargebee hosted page by ID.',
                'icon' => 'ph:browser',
            ],
            'chargebee_get_invoice' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeGetInvoice',
                'type' => 'read',
                'name' => 'Get Invoice',
                'description' => 'Retrieve detailed information about a specific Chargebee invoice by its ID, including line items, totals, tax, and payment status.',
                'icon' => 'ph:file-text',
            ],
            'chargebee_get_invoice_pdf' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeGetInvoicePdf',
                'type' => 'read',
                'name' => 'Get Invoice Pdf',
                'description' => 'Retrieve invoice PDF metadata and download URL.',
                'icon' => 'ph:file-text',
            ],
            'chargebee_get_item' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeGetItem',
                'type' => 'read',
                'name' => 'Get Item',
                'description' => 'Retrieve a Chargebee item by ID.',
                'icon' => 'ph:package',
            ],
            'chargebee_get_item_price' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeGetItemPrice',
                'type' => 'read',
                'name' => 'Get Item Price',
                'description' => 'Retrieve a Chargebee item price by ID.',
                'icon' => 'ph:tag',
            ],
            'chargebee_get_order' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeGetOrder',
                'type' => 'read',
                'name' => 'Get Order',
                'description' => 'Retrieve a Chargebee order by ID.',
                'icon' => 'ph:database',
            ],
            'chargebee_get_payment_source' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeGetPaymentSource',
                'type' => 'read',
                'name' => 'Get Payment Source',
                'description' => 'Retrieve a payment source by ID.',
                'icon' => 'ph:bank',
            ],
            'chargebee_get_subscription' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeGetSubscription',
                'type' => 'read',
                'name' => 'Get Subscription',
                'description' => 'Retrieve detailed information about a specific Chargebee subscription by its ID, including plan details, billing period, status, and associated customer.',
                'icon' => 'ph:arrows-clockwise',
            ],
            'chargebee_get_transaction' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeGetTransaction',
                'type' => 'read',
                'name' => 'Get Transaction',
                'description' => 'Retrieve a Chargebee transaction by ID.',
                'icon' => 'ph:credit-card',
            ],
            'chargebee_list_attached_items' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeListAttachedItems',
                'type' => 'read',
                'name' => 'List Attached Items',
                'description' => 'List Chargebee attached items with filters and pagination.',
                'icon' => 'ph:package',
            ],
            'chargebee_list_business_entities' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeListBusinessEntities',
                'type' => 'read',
                'name' => 'List Business Entities',
                'description' => 'List Chargebee business entitys with filters and pagination.',
                'icon' => 'ph:database',
            ],
            'chargebee_list_coupons' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeListCoupons',
                'type' => 'read',
                'name' => 'List Coupons',
                'description' => 'List Chargebee coupons with filters and pagination.',
                'icon' => 'ph:ticket',
            ],
            'chargebee_list_credit_notes' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeListCreditNotes',
                'type' => 'read',
                'name' => 'List Credit Notes',
                'description' => 'List Chargebee credit notes with filters and pagination.',
                'icon' => 'ph:receipt',
            ],
            'chargebee_list_currencies' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeListCurrencies',
                'type' => 'read',
                'name' => 'List Currencies',
                'description' => 'List Chargebee currencies.',
                'icon' => 'ph:database',
            ],
            'chargebee_list_customers' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeListCustomers',
                'type' => 'read',
                'name' => 'List Customers',
                'description' => 'List customers from Chargebee with pagination. Returns customer details including email, name, company, and billing address.',
                'icon' => 'ph:user',
            ],
            'chargebee_list_events' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeListEvents',
                'type' => 'read',
                'name' => 'List Events',
                'description' => 'List Chargebee events with filters and pagination.',
                'icon' => 'ph:bell',
            ],
            'chargebee_list_hosted_pages' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeListHostedPages',
                'type' => 'read',
                'name' => 'List Hosted Pages',
                'description' => 'List Chargebee hosted pages with filters and pagination.',
                'icon' => 'ph:browser',
            ],
            'chargebee_list_invoice_payment_schedules' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeListInvoicePaymentSchedules',
                'type' => 'read',
                'name' => 'List Invoice Payment Schedules',
                'description' => 'Retrieve payment schedules for an invoice.',
                'icon' => 'ph:file-text',
            ],
            'chargebee_list_invoices' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeListInvoices',
                'type' => 'read',
                'name' => 'List Invoices',
                'description' => 'List invoices from Chargebee. Supports filtering by status (paid, posted, payment_due, not_paid, voided, pending) and pagination.',
                'icon' => 'ph:file-text',
            ],
            'chargebee_list_item_prices' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeListItemPrices',
                'type' => 'read',
                'name' => 'List Item Prices',
                'description' => 'List Chargebee item prices with filters and pagination.',
                'icon' => 'ph:tag',
            ],
            'chargebee_list_items' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeListItems',
                'type' => 'read',
                'name' => 'List Items',
                'description' => 'List Chargebee items with filters and pagination.',
                'icon' => 'ph:package',
            ],
            'chargebee_list_orders' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeListOrders',
                'type' => 'read',
                'name' => 'List Orders',
                'description' => 'List Chargebee orders with filters and pagination.',
                'icon' => 'ph:database',
            ],
            'chargebee_list_payment_sources_for_customer' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeListPaymentSourcesForCustomer',
                'type' => 'read',
                'name' => 'List Payment Sources For Customer',
                'description' => 'List payment sources for a customer.',
                'icon' => 'ph:user',
            ],
            'chargebee_list_subscriptions' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeListSubscriptions',
                'type' => 'read',
                'name' => 'List Subscriptions',
                'description' => 'List subscriptions from Chargebee. Supports filtering by state (active, cancelled, non_renewing, paused, in_trial, future) and pagination. Returns subscription details including plan, status, and billing period.',
                'icon' => 'ph:arrows-clockwise',
            ],
            'chargebee_list_transactions' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeListTransactions',
                'type' => 'read',
                'name' => 'List Transactions',
                'description' => 'List Chargebee transactions with filters and pagination.',
                'icon' => 'ph:credit-card',
            ],
            'chargebee_manage_payment_sources_hosted_page' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeManagePaymentSourcesHostedPage',
                'type' => 'write',
                'name' => 'Manage Payment Sources Hosted Page',
                'description' => 'Create a hosted page for managing payment sources.',
                'icon' => 'ph:browser',
            ],
            'chargebee_pause_subscription' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeePauseSubscription',
                'type' => 'write',
                'name' => 'Pause Subscription',
                'description' => 'Pause a Chargebee subscription.',
                'icon' => 'ph:arrows-clockwise',
            ],
            'chargebee_reactivate_subscription' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeReactivateSubscription',
                'type' => 'write',
                'name' => 'Reactivate Subscription',
                'description' => 'Reactivate a cancelled Chargebee subscription.',
                'icon' => 'ph:arrows-clockwise',
            ],
            'chargebee_record_invoice_payment' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeRecordInvoicePayment',
                'type' => 'write',
                'name' => 'Record Invoice Payment',
                'description' => 'Record an offline payment for an invoice.',
                'icon' => 'ph:file-text',
            ],
            'chargebee_record_refund_for_transaction' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeRecordRefundForTransaction',
                'type' => 'write',
                'name' => 'Record Refund For Transaction',
                'description' => 'Record an offline refund for a transaction.',
                'icon' => 'ph:credit-card',
            ],
            'chargebee_remove_scheduled_cancellation' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeRemoveScheduledCancellation',
                'type' => 'write',
                'name' => 'Remove Scheduled Cancellation',
                'description' => 'Remove a scheduled subscription cancellation.',
                'icon' => 'ph:database',
            ],
            'chargebee_remove_scheduled_changes' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeRemoveScheduledChanges',
                'type' => 'write',
                'name' => 'Remove Scheduled Changes',
                'description' => 'Remove scheduled changes from a subscription.',
                'icon' => 'ph:database',
            ],
            'chargebee_resume_subscription' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeResumeSubscription',
                'type' => 'write',
                'name' => 'Resume Subscription',
                'description' => 'Resume a paused Chargebee subscription.',
                'icon' => 'ph:arrows-clockwise',
            ],
            'chargebee_retrieve_subscription_with_scheduled_changes' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeRetrieveSubscriptionWithScheduledChanges',
                'type' => 'read',
                'name' => 'Retrieve Subscription With Scheduled Changes',
                'description' => 'Retrieve a subscription including scheduled changes.',
                'icon' => 'ph:arrows-clockwise',
            ],
            'chargebee_update_coupon' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeUpdateCoupon',
                'type' => 'write',
                'name' => 'Update Coupon',
                'description' => 'Update a Chargebee coupon by ID.',
                'icon' => 'ph:ticket',
            ],
            'chargebee_update_customer' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeUpdateCustomer',
                'type' => 'write',
                'name' => 'Update Customer',
                'description' => 'Update a Chargebee customer by ID.',
                'icon' => 'ph:user',
            ],
            'chargebee_update_item' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeUpdateItem',
                'type' => 'write',
                'name' => 'Update Item',
                'description' => 'Update a Chargebee item by ID.',
                'icon' => 'ph:package',
            ],
            'chargebee_update_item_price' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeUpdateItemPrice',
                'type' => 'write',
                'name' => 'Update Item Price',
                'description' => 'Update a Chargebee item price by ID.',
                'icon' => 'ph:tag',
            ],
            'chargebee_update_payment_method_hosted_page' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeUpdatePaymentMethodHostedPage',
                'type' => 'write',
                'name' => 'Update Payment Method Hosted Page',
                'description' => 'Create a hosted page for updating payment method.',
                'icon' => 'ph:browser',
            ],
            'chargebee_update_subscription_for_items' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeUpdateSubscriptionForItems',
                'type' => 'write',
                'name' => 'Update Subscription For Items',
                'description' => 'Update a subscription with Product Catalog 2.0 item prices.',
                'icon' => 'ph:arrows-clockwise',
            ],
            'chargebee_void_credit_note' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeVoidCreditNote',
                'type' => 'write',
                'name' => 'Void Credit Note',
                'description' => 'Void a Chargebee credit note.',
                'icon' => 'ph:receipt',
            ],
            'chargebee_void_invoice' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeVoidInvoice',
                'type' => 'write',
                'name' => 'Void Invoice',
                'description' => 'Void a Chargebee invoice.',
                'icon' => 'ph:file-text',
            ],
            'chargebee_void_transaction' => [
                'class' => 'OpenCompany\\Integrations\\Chargebee\\Tools\\ChargebeeVoidTransaction',
                'type' => 'write',
                'name' => 'Void Transaction',
                'description' => 'Void a Chargebee transaction.',
                'icon' => 'ph:credit-card',
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
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
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
            $creds = app(CredentialResolver::class);

            $service = new ChargebeeService(
                accessToken: $creds->get('chargebee', 'access_token', '', $account),
                siteName: $creds->get('chargebee', 'site_name', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(ChargebeeService::class));
    }
}
