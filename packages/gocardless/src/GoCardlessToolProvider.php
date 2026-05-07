<?php

namespace OpenCompany\Integrations\GoCardless;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessListBalance;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessGetBankAccountDetails;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessCreateBankAccountHolderVerification;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessGetBankAccountHolderVerifications;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessCreateBankAuthorisation;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessGetBankAuthorisations;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessCreateBankDetailsLookup;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessCreateBillingRequest;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessListBillingRequest;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessCollectCustomerDetailsBillingRequest;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessCollectBankAccountBillingRequest;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessConfirmPayerDetailsBillingRequest;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessFulfilBillingRequest;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessCancelBillingRequest;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessGetBillingRequests;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessNotifyBillingRequest;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessFallbackBillingRequest;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessChooseCurrencyBillingRequest;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessSelectInstitutionBillingRequest;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessCreateBillingRequestFlow;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessInitialiseBillingRequestFlow;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessListBillingRequestTemplate;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessCreateBillingRequestTemplate;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessGetBillingRequestTemplates;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessUpdateBillingRequestTemplates;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessCreateWithActionsBillingRequests;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessCreateBlock;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessListBlock;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessGetBlocks;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessDisableBlock;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessEnableBlock;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessBlockByRefBlocks;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessCreateCreditor;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessListCreditor;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessGetCreditors;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessUpdateCreditors;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessCreateCreditorBankAccount;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessListCreditorBankAccount;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessGetCreditorBankAccounts;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessDisableCreditorBankAccount;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessListCurrencyExchangeRate;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessCreateCustomer;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessListCustomer;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessGetCustomers;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessUpdateCustomers;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessDeleteCustomers;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessCreateCustomerBankAccount;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessListCustomerBankAccount;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessGetCustomerBankAccounts;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessUpdateCustomerBankAccounts;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessDisableCustomerBankAccount;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessHandleCustomerNotification;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessListEvent;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessGetEvents;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessGetExports;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessListExport;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessGetFundsAvailability;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessCreateInstalmentSchedule;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessListInstalmentSchedule;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessGetInstalmentSchedules;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessUpdateInstalmentSchedules;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessCancelInstalmentSchedule;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessListInstitution;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessGetInstitutionsFromInstitution;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessLogosBranding;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessCreateMandate;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessListMandate;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessGetMandates;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessUpdateMandates;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessCancelMandate;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessReinstateMandate;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessCreateMandateImport;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessGetMandateImports;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessSubmitMandateImport;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessCancelMandateImport;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessCreateMandateImportEntry;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessListMandateImportEntry;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessCreateMandatePdf;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessListNegativeBalanceLimit;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessCreateOutboundPayment;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessListOutboundPayment;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessWithdrawalOutboundPayments;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessCancelOutboundPayment;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessApproveOutboundPayment;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessGetOutboundPayments;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessUpdateOutboundPayments;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessListOutboundPaymentsStats;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessCreateOutboundPaymentImport;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessListOutboundPaymentImport;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessGetOutboundPaymentImports;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessListOutboundPaymentImportEntry;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessGetPayerAuthorisations;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessUpdatePayerAuthorisations;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessCreatePayerAuthorisation;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessSubmitPayerAuthorisation;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessConfirmPayerAuthorisation;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessPayerThemesBranding;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessCreatePayment;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessListPayment;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessGetPayments;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessUpdatePayments;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessCancelPayment;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessRetryPayment;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessGetPaymentAccounts;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessListPaymentAccount;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessGetPaymentAccountTransactions;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessGetTransactionsFromPaymentAccountTransaction;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessListPayout;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessGetPayouts;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessUpdatePayouts;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessListPayoutItem;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessCreateRedirectFlow;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessGetRedirectFlows;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessCompleteRedirectFlow;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessCreateRefund;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessListRefund;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessGetRefunds;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessUpdateRefunds;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessRunScenarioSimulator;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessCreateSchemeIdentifier;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessListSchemeIdentifier;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessGetSchemeIdentifiers;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessCreateSubscription;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessListSubscription;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessGetSubscriptions;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessUpdateSubscriptions;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessPauseSubscription;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessResumeSubscription;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessCancelSubscription;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessListTaxRate;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessGetTaxRates;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessGetTransferredMandates;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessCreateVerificationDetail;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessListVerificationDetail;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessListWebhook;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessGetWebhooks;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessRetryWebhook;

/**
 * Tool catalog and configuration metadata for GoCardless.
 *
 * Exposes the official GoCardless OpenAPI operation set as endpoint-specific
 * tools and resolves account-specific access tokens for multi-account hosts.
 */
class GoCardlessToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /** @return array<string, mixed> */
    public function integrationCapabilities(): array
    {
        return ['auth' => ['strategy' => 'bearer_token', 'legacy_auth_type' => 'api_key', 'credential_mode' => 'stored_token', 'setup_flows' => ['manual_token'], 'requires_browser_for_setup' => false, 'refreshable' => false, 'token_keys' => ['api_key'], 'notes' => ['GoCardless uses Authorization: Bearer <access_token> and a required GoCardless-Version header.']], 'host_availability' => ['web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token'], 'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token', 'runtime_mode' => 'normal']], 'runtime_requirements' => [], 'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true]];
    }

    public function appName(): string { return 'gocardless'; }
    public function appMeta(): array { return ['label' => 'GoCardless', 'description' => 'Payments, mandates, billing requests, customers, payouts, refunds, subscriptions, events, and webhooks', 'icon' => 'ph:bank', 'logo' => 'ph:bank']; }
    public function integrationMeta(): array { return ['name' => 'GoCardless', 'description' => 'Manage GoCardless payments, mandates, billing requests, customers, creditor accounts, payouts, refunds, subscriptions, events, institutions, and webhook records.', 'icon' => 'ph:bank', 'logo' => 'ph:bank', 'category' => 'data', 'badge' => 'verified', 'docs_url' => 'https://developer.gocardless.com/api-reference/openapi/']; }
    public function configSchema(): array { return [['key' => 'api_key', 'type' => 'secret', 'label' => 'Access Token', 'placeholder' => 'GoCardless access token', 'hint' => 'Sent as Authorization: Bearer <access_token>.', 'required' => true], ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://api.gocardless.com', 'hint' => 'Use https://api.gocardless.com for production or a sandbox base URL when appropriate.', 'default' => 'https://api.gocardless.com'], ['key' => 'api_version', 'type' => 'text', 'label' => 'API Version', 'placeholder' => '2015-07-06', 'hint' => 'Sent as GoCardless-Version. The official OpenAPI schema version is 2015-07-06.', 'default' => '2015-07-06']]; }

    /** @param  array<string, mixed>  $config  Credential and endpoint settings. @return array{success: bool, message?: string, error?: string} */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.gocardless.com'), '/');
        $apiVersion = (string) ($config['api_version'] ?? '2015-07-06');
        if ($apiKey === '') { return ['success' => false, 'error' => 'GoCardless access token is required.']; }

        try {
            $response = Http::withHeaders(['Authorization' => 'Bearer ' . $apiKey, 'Accept' => 'application/json', 'GoCardless-Version' => $apiVersion])->timeout(10)->get($baseUrl . '/creditors', ['limit' => 1]);
            if (!$response->successful()) { return ['success' => false, 'error' => 'GoCardless API returned HTTP ' . $response->status() . '.']; }
            return ['success' => true, 'message' => 'Connected to GoCardless at ' . $baseUrl . '.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array { return ['api_key' => 'nullable|string', 'url' => 'nullable|url', 'api_version' => 'nullable|string']; }
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.gocardless.com'],
            ['key' => 'api_version', 'type' => 'text', 'label' => 'API Version', 'required' => false, 'default' => '2015-07-06'],
        ];
    }
    public function tools(): array { return [
            'gocardless_list_balance' => [
                'class' => GoCardlessListBalance::class,
                'name' => 'List Balance',
                'description' => 'Returns a [cursor-paginated](#api-usage-cursor-pagination) list of balances for a given creditor. This endpoint is rate limited to 60 requests per minute.

Official GoCardless endpoint: GET /balances.',
                'parameters' => [],
            ],
            'gocardless_get_bank_account_details' => [
                'class' => GoCardlessGetBankAccountDetails::class,
                'name' => 'Get Bank Account Details',
                'description' => 'Returns bank account details in the flattened JSON Web Encryption format described in RFC 7516. You must specify a `Gc-Key-Id` header when using this endpoint. See [Public Key Setup](https://developer.gocardless.com/gc-embed/bank-details-access#public_key_setup) for more details.

Official GoCardless endpoint: GET /bank_account_details/{customer_bank_account_id}.',
                'parameters' => [
                    'customer_bank_account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The customer bank account id',
                    ],
                    'gc_key_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Public key identifier sent as the Gc-Key-Id header for encrypted bank account details.',
                    ],
                ],
            ],
            'gocardless_create_bank_account_holder_verification' => [
                'class' => GoCardlessCreateBankAccountHolderVerification::class,
                'name' => 'Create Bank Account Holder Verification',
                'description' => 'Verify the account holder of the bank account. A complete verification can be attached when creating an outbound payment. This endpoint allows partner merchants to create Confirmation of Payee checks on customer bank accounts before sending outbound payments.

Official GoCardless endpoint: POST /bank_account_holder_verifications.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_get_bank_account_holder_verifications' => [
                'class' => GoCardlessGetBankAccountHolderVerifications::class,
                'name' => 'Get Bank Account Holder Verifications',
                'description' => 'Fetches a bank account holder verification by ID.

Official GoCardless endpoint: GET /bank_account_holder_verifications/{bank_account_holder_verification_id}.',
                'parameters' => [
                    'bank_account_holder_verification_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The bank account holder verification id',
                    ],
                ],
            ],
            'gocardless_create_bank_authorisation' => [
                'class' => GoCardlessCreateBankAuthorisation::class,
                'name' => 'Create Bank Authorisation',
                'description' => 'Create a Bank Authorisation.

Official GoCardless endpoint: POST /bank_authorisations.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_get_bank_authorisations' => [
                'class' => GoCardlessGetBankAuthorisations::class,
                'name' => 'Get Bank Authorisations',
                'description' => 'Get a single bank authorisation.

Official GoCardless endpoint: GET /bank_authorisations/{bank_authorisation_id}.',
                'parameters' => [
                    'bank_authorisation_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The bank authorisation id',
                    ],
                ],
            ],
            'gocardless_create_bank_details_lookup' => [
                'class' => GoCardlessCreateBankDetailsLookup::class,
                'name' => 'Create Bank Details Lookup',
                'description' => 'Perform a bank details lookup

Official GoCardless endpoint: POST /bank_details_lookups.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_create_billing_request' => [
                'class' => GoCardlessCreateBillingRequest::class,
                'name' => 'Create Billing Request',
                'description' => '<p class="notice"><strong>Important</strong>: All properties associated with `subscription_request` and `instalment_schedule_request` are only supported for ACH and PAD schemes.</p>

Official GoCardless endpoint: POST /billing_requests.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_list_billing_request' => [
                'class' => GoCardlessListBillingRequest::class,
                'name' => 'List Billing Request',
                'description' => 'Returns a [cursor-paginated](#api-usage-cursor-pagination) list of your billing requests.

Official GoCardless endpoint: GET /billing_requests.',
                'parameters' => [],
            ],
            'gocardless_collect_customer_details_billing_request' => [
                'class' => GoCardlessCollectCustomerDetailsBillingRequest::class,
                'name' => 'Collect Customer Details Billing Request',
                'description' => 'Collect customer details

Official GoCardless endpoint: POST /billing_requests/{billing_request_id}/actions/collect_customer_details.',
                'parameters' => [
                    'billing_request_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The billing request id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_collect_bank_account_billing_request' => [
                'class' => GoCardlessCollectBankAccountBillingRequest::class,
                'name' => 'Collect Bank Account Billing Request',
                'description' => 'Collect bank account details

Official GoCardless endpoint: POST /billing_requests/{billing_request_id}/actions/collect_bank_account.',
                'parameters' => [
                    'billing_request_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The billing request id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_confirm_payer_details_billing_request' => [
                'class' => GoCardlessConfirmPayerDetailsBillingRequest::class,
                'name' => 'Confirm Payer Details Billing Request',
                'description' => 'This is needed when you have a mandate request. As a scheme compliance rule we are required to allow the payer to crosscheck the details entered by them and confirm it.

Official GoCardless endpoint: POST /billing_requests/{billing_request_id}/actions/confirm_payer_details.',
                'parameters' => [
                    'billing_request_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The billing request id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_fulfil_billing_request' => [
                'class' => GoCardlessFulfilBillingRequest::class,
                'name' => 'Fulfil Billing Request',
                'description' => 'If a billing request is ready to be fulfilled, call this endpoint to cause it to fulfil, executing the payment.

Official GoCardless endpoint: POST /billing_requests/{billing_request_id}/actions/fulfil.',
                'parameters' => [
                    'billing_request_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The billing request id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_cancel_billing_request' => [
                'class' => GoCardlessCancelBillingRequest::class,
                'name' => 'Cancel Billing Request',
                'description' => 'Immediately cancels a billing request, causing all billing request flows to expire.

Official GoCardless endpoint: POST /billing_requests/{billing_request_id}/actions/cancel.',
                'parameters' => [
                    'billing_request_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The billing request id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_get_billing_requests' => [
                'class' => GoCardlessGetBillingRequests::class,
                'name' => 'Get Billing Requests',
                'description' => 'Fetches a billing request

Official GoCardless endpoint: GET /billing_requests/{billing_request_id}.',
                'parameters' => [
                    'billing_request_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The billing request id',
                    ],
                ],
            ],
            'gocardless_notify_billing_request' => [
                'class' => GoCardlessNotifyBillingRequest::class,
                'name' => 'Notify Billing Request',
                'description' => 'Notifies the customer linked to the billing request, asking them to authorise it. Currently, the customer can only be notified by email. This endpoint is currently supported only for Instant Bank Pay Billing Requests.

Official GoCardless endpoint: POST /billing_requests/{billing_request_id}/actions/notify.',
                'parameters' => [
                    'billing_request_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The billing request id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_fallback_billing_request' => [
                'class' => GoCardlessFallbackBillingRequest::class,
                'name' => 'Fallback Billing Request',
                'description' => 'Triggers a fallback from the open-banking flow to direct debit. Note, the billing request must have fallback enabled.

Official GoCardless endpoint: POST /billing_requests/{billing_request_id}/actions/fallback.',
                'parameters' => [
                    'billing_request_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The billing request id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_choose_currency_billing_request' => [
                'class' => GoCardlessChooseCurrencyBillingRequest::class,
                'name' => 'Choose Currency Billing Request',
                'description' => 'This will allow for the updating of the currency and subsequently the scheme if needed for a Billing Request. This will only be available for mandate only flows which do not have the lock_currency flag set to true on the Billing Request Flow. It will also not support any request which has a payments request.

Official GoCardless endpoint: POST /billing_requests/{billing_request_id}/actions/choose_currency.',
                'parameters' => [
                    'billing_request_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The billing request id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_select_institution_billing_request' => [
                'class' => GoCardlessSelectInstitutionBillingRequest::class,
                'name' => 'Select Institution Billing Request',
                'description' => 'Creates an Institution object and attaches it to the Billing Request

Official GoCardless endpoint: POST /billing_requests/{billing_request_id}/actions/select_institution.',
                'parameters' => [
                    'billing_request_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The billing request id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_create_billing_request_flow' => [
                'class' => GoCardlessCreateBillingRequestFlow::class,
                'name' => 'Create Billing Request Flow',
                'description' => 'Creates a new billing request flow.

Official GoCardless endpoint: POST /billing_request_flows.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_initialise_billing_request_flow' => [
                'class' => GoCardlessInitialiseBillingRequestFlow::class,
                'name' => 'Initialise Billing Request Flow',
                'description' => 'Returns the flow having generated a fresh session token which can be used to power integrations that manipulate the flow.

Official GoCardless endpoint: POST /billing_request_flows/{billing_request_flow_id}/actions/initialise.',
                'parameters' => [
                    'billing_request_flow_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The billing request flow id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_list_billing_request_template' => [
                'class' => GoCardlessListBillingRequestTemplate::class,
                'name' => 'List Billing Request Template',
                'description' => 'Returns a [cursor-paginated](#api-usage-cursor-pagination) list of your Billing Request Templates.

Official GoCardless endpoint: GET /billing_request_templates.',
                'parameters' => [],
            ],
            'gocardless_create_billing_request_template' => [
                'class' => GoCardlessCreateBillingRequestTemplate::class,
                'name' => 'Create Billing Request Template',
                'description' => 'Create a Billing Request Template

Official GoCardless endpoint: POST /billing_request_templates.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_get_billing_request_templates' => [
                'class' => GoCardlessGetBillingRequestTemplates::class,
                'name' => 'Get Billing Request Templates',
                'description' => 'Fetches a Billing Request Template

Official GoCardless endpoint: GET /billing_request_templates/{billing_request_template_id}.',
                'parameters' => [
                    'billing_request_template_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The billing request template id',
                    ],
                ],
            ],
            'gocardless_update_billing_request_templates' => [
                'class' => GoCardlessUpdateBillingRequestTemplates::class,
                'name' => 'Update Billing Request Templates',
                'description' => 'Updates a Billing Request Template, which will affect all future Billing Requests created by this template.

Official GoCardless endpoint: PUT /billing_request_templates/{billing_request_template_id}.',
                'parameters' => [
                    'billing_request_template_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The billing request template id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_create_with_actions_billing_requests' => [
                'class' => GoCardlessCreateWithActionsBillingRequests::class,
                'name' => 'Create With Actions Billing Requests',
                'description' => 'Creates a billing request and completes any specified actions in a single request. This endpoint allows you to create a billing request and immediately complete actions such as collecting customer details, bank account details, or other required actions.

Official GoCardless endpoint: POST /billing_requests/create_with_actions.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_create_block' => [
                'class' => GoCardlessCreateBlock::class,
                'name' => 'Create Block',
                'description' => 'Creates a new Block of a given type. By default it will be active.

Official GoCardless endpoint: POST /blocks.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_list_block' => [
                'class' => GoCardlessListBlock::class,
                'name' => 'List Block',
                'description' => 'Returns a [cursor-paginated](#api-usage-cursor-pagination) list of your blocks.

Official GoCardless endpoint: GET /blocks.',
                'parameters' => [],
            ],
            'gocardless_get_blocks' => [
                'class' => GoCardlessGetBlocks::class,
                'name' => 'Get Blocks',
                'description' => 'Retrieves the details of an existing block.

Official GoCardless endpoint: GET /blocks/{block_id}.',
                'parameters' => [
                    'block_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The block id',
                    ],
                ],
            ],
            'gocardless_disable_block' => [
                'class' => GoCardlessDisableBlock::class,
                'name' => 'Disable Block',
                'description' => 'Disables a block so that it no longer will prevent mandate creation.

Official GoCardless endpoint: POST /blocks/{block_id}/actions/disable.',
                'parameters' => [
                    'block_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The block id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_enable_block' => [
                'class' => GoCardlessEnableBlock::class,
                'name' => 'Enable Block',
                'description' => 'Enables a previously disabled block so that it will prevent mandate creation

Official GoCardless endpoint: POST /blocks/{block_id}/actions/enable.',
                'parameters' => [
                    'block_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The block id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_block_by_ref_blocks' => [
                'class' => GoCardlessBlockByRefBlocks::class,
                'name' => 'Block By Ref Blocks',
                'description' => 'Creates new blocks for a given reference. By default blocks will be active. Returns 201 if at least one block was created. Returns 200 if there were no new blocks created.

Official GoCardless endpoint: POST /blocks/block_by_ref.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_create_creditor' => [
                'class' => GoCardlessCreateCreditor::class,
                'name' => 'Create Creditor',
                'description' => 'Creates a new creditor.

Official GoCardless endpoint: POST /creditors.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_list_creditor' => [
                'class' => GoCardlessListCreditor::class,
                'name' => 'List Creditor',
                'description' => 'Returns a [cursor-paginated](#api-usage-cursor-pagination) list of your creditors.

Official GoCardless endpoint: GET /creditors.',
                'parameters' => [],
            ],
            'gocardless_get_creditors' => [
                'class' => GoCardlessGetCreditors::class,
                'name' => 'Get Creditors',
                'description' => 'Retrieves the details of an existing creditor.

Official GoCardless endpoint: GET /creditors/{creditor_id}.',
                'parameters' => [
                    'creditor_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The creditor id',
                    ],
                ],
            ],
            'gocardless_update_creditors' => [
                'class' => GoCardlessUpdateCreditors::class,
                'name' => 'Update Creditors',
                'description' => 'Updates a creditor object. Supports all of the fields supported when creating a creditor.

Official GoCardless endpoint: PUT /creditors/{creditor_id}.',
                'parameters' => [
                    'creditor_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The creditor id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_create_creditor_bank_account' => [
                'class' => GoCardlessCreateCreditorBankAccount::class,
                'name' => 'Create Creditor Bank Account',
                'description' => 'Creates a new creditor bank account object.

Official GoCardless endpoint: POST /creditor_bank_accounts.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_list_creditor_bank_account' => [
                'class' => GoCardlessListCreditorBankAccount::class,
                'name' => 'List Creditor Bank Account',
                'description' => 'Returns a [cursor-paginated](#api-usage-cursor-pagination) list of your creditor bank accounts.

Official GoCardless endpoint: GET /creditor_bank_accounts.',
                'parameters' => [],
            ],
            'gocardless_get_creditor_bank_accounts' => [
                'class' => GoCardlessGetCreditorBankAccounts::class,
                'name' => 'Get Creditor Bank Accounts',
                'description' => 'Retrieves the details of an existing creditor bank account.

Official GoCardless endpoint: GET /creditor_bank_accounts/{creditor_bank_account_id}.',
                'parameters' => [
                    'creditor_bank_account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The creditor bank account id',
                    ],
                ],
            ],
            'gocardless_disable_creditor_bank_account' => [
                'class' => GoCardlessDisableCreditorBankAccount::class,
                'name' => 'Disable Creditor Bank Account',
                'description' => 'Immediately disables the bank account, no money can be paid out to a disabled account. This will return a `disable_failed` error if the bank account has already been disabled. A disabled bank account can be re-enabled by creating a new bank account resource with the same details.

Official GoCardless endpoint: POST /creditor_bank_accounts/{creditor_bank_account_id}/actions/disable.',
                'parameters' => [
                    'creditor_bank_account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The creditor bank account id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_list_currency_exchange_rate' => [
                'class' => GoCardlessListCurrencyExchangeRate::class,
                'name' => 'List Currency Exchange Rate',
                'description' => 'Returns a [cursor-paginated](#api-usage-cursor-pagination) list of all exchange rates.

Official GoCardless endpoint: GET /currency_exchange_rates.',
                'parameters' => [],
            ],
            'gocardless_create_customer' => [
                'class' => GoCardlessCreateCustomer::class,
                'name' => 'Create Customer',
                'description' => 'Creates a new customer object.

Official GoCardless endpoint: POST /customers.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_list_customer' => [
                'class' => GoCardlessListCustomer::class,
                'name' => 'List Customer',
                'description' => 'Returns a [cursor-paginated](#api-usage-cursor-pagination) list of your customers.

Official GoCardless endpoint: GET /customers.',
                'parameters' => [],
            ],
            'gocardless_get_customers' => [
                'class' => GoCardlessGetCustomers::class,
                'name' => 'Get Customers',
                'description' => 'Retrieves the details of an existing customer.

Official GoCardless endpoint: GET /customers/{customer_id}.',
                'parameters' => [
                    'customer_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The customer id',
                    ],
                ],
            ],
            'gocardless_update_customers' => [
                'class' => GoCardlessUpdateCustomers::class,
                'name' => 'Update Customers',
                'description' => 'Updates a customer object. Supports all of the fields supported when creating a customer.

Official GoCardless endpoint: PUT /customers/{customer_id}.',
                'parameters' => [
                    'customer_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The customer id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_delete_customers' => [
                'class' => GoCardlessDeleteCustomers::class,
                'name' => 'Delete Customers',
                'description' => 'Removed customers will not appear in search results or lists of customers (in our API or exports), and it will not be possible to load an individually removed customer by ID. <p class="restricted-notice"><strong>The action of removing a customer cannot be reversed, so please use with care.</strong></p>

Official GoCardless endpoint: DELETE /customers/{customer_id}.',
                'parameters' => [
                    'customer_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The customer id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                ],
            ],
            'gocardless_create_customer_bank_account' => [
                'class' => GoCardlessCreateCustomerBankAccount::class,
                'name' => 'Create Customer Bank Account',
                'description' => 'Creates a new customer bank account object. There are three different ways to supply bank account details: - [Local details](#appendix-local-bank-details) - IBAN - [Customer Bank Account Tokens](#javascript-flow-create-a-customer-bank-account-token) For more information on the different fields required in each country, see [local bank details](#appendix-local-bank-details).

Official GoCardless endpoint: POST /customer_bank_accounts.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_list_customer_bank_account' => [
                'class' => GoCardlessListCustomerBankAccount::class,
                'name' => 'List Customer Bank Account',
                'description' => 'Returns a [cursor-paginated](#api-usage-cursor-pagination) list of your bank accounts.

Official GoCardless endpoint: GET /customer_bank_accounts.',
                'parameters' => [],
            ],
            'gocardless_get_customer_bank_accounts' => [
                'class' => GoCardlessGetCustomerBankAccounts::class,
                'name' => 'Get Customer Bank Accounts',
                'description' => 'Retrieves the details of an existing bank account.

Official GoCardless endpoint: GET /customer_bank_accounts/{customer_bank_account_id}.',
                'parameters' => [
                    'customer_bank_account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The customer bank account id',
                    ],
                ],
            ],
            'gocardless_update_customer_bank_accounts' => [
                'class' => GoCardlessUpdateCustomerBankAccounts::class,
                'name' => 'Update Customer Bank Accounts',
                'description' => 'Updates a customer bank account object. Only the metadata parameter is allowed.

Official GoCardless endpoint: PUT /customer_bank_accounts/{customer_bank_account_id}.',
                'parameters' => [
                    'customer_bank_account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The customer bank account id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_disable_customer_bank_account' => [
                'class' => GoCardlessDisableCustomerBankAccount::class,
                'name' => 'Disable Customer Bank Account',
                'description' => 'Immediately cancels all associated mandates and cancellable payments. This will return a `disable_failed` error if the bank account has already been disabled. A disabled bank account can be re-enabled by creating a new bank account resource with the same details.

Official GoCardless endpoint: POST /customer_bank_accounts/{customer_bank_account_id}/actions/disable.',
                'parameters' => [
                    'customer_bank_account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The customer bank account id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_handle_customer_notification' => [
                'class' => GoCardlessHandleCustomerNotification::class,
                'name' => 'Handle Customer Notification',
                'description' => '"Handling" a notification means that you have sent the notification yourself (and don\'t want GoCardless to send it). If the notification has already been actioned, or the deadline to notify has passed, this endpoint will return an `already_actioned` error and you should not take further action. This endpoint takes no additional parameters.

Official GoCardless endpoint: POST /customer_notifications/{customer_notification_id}/actions/handle.',
                'parameters' => [
                    'customer_notification_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The customer notification id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_list_event' => [
                'class' => GoCardlessListEvent::class,
                'name' => 'List Event',
                'description' => 'Returns a [cursor-paginated](#api-usage-cursor-pagination) list of your events.

Official GoCardless endpoint: GET /events.',
                'parameters' => [],
            ],
            'gocardless_get_events' => [
                'class' => GoCardlessGetEvents::class,
                'name' => 'Get Events',
                'description' => 'Retrieves the details of a single event.

Official GoCardless endpoint: GET /events/{event_id}.',
                'parameters' => [
                    'event_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The event id',
                    ],
                ],
            ],
            'gocardless_get_exports' => [
                'class' => GoCardlessGetExports::class,
                'name' => 'Get Exports',
                'description' => 'Returns a single export.

Official GoCardless endpoint: GET /exports/{export_id}.',
                'parameters' => [
                    'export_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The export id',
                    ],
                ],
            ],
            'gocardless_list_export' => [
                'class' => GoCardlessListExport::class,
                'name' => 'List Export',
                'description' => 'Returns a list of exports which are available for download.

Official GoCardless endpoint: GET /exports.',
                'parameters' => [],
            ],
            'gocardless_get_funds_availability' => [
                'class' => GoCardlessGetFundsAvailability::class,
                'name' => 'Get Funds Availability',
                'description' => 'Checks if the payer\'s current balance is sufficient to cover the amount the merchant wants to charge within the consent parameters defined on the mandate.

Official GoCardless endpoint: GET /funds_availability/{mandate_id}.',
                'parameters' => [
                    'mandate_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The mandate id',
                    ],
                ],
            ],
            'gocardless_create_instalment_schedule' => [
                'class' => GoCardlessCreateInstalmentSchedule::class,
                'name' => 'Create Instalment Schedule',
                'description' => 'Create (with schedule)

Official GoCardless endpoint: POST /instalment_schedules.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_list_instalment_schedule' => [
                'class' => GoCardlessListInstalmentSchedule::class,
                'name' => 'List Instalment Schedule',
                'description' => 'Returns a [cursor-paginated](#api-usage-cursor-pagination) list of your instalment schedules.

Official GoCardless endpoint: GET /instalment_schedules.',
                'parameters' => [],
            ],
            'gocardless_get_instalment_schedules' => [
                'class' => GoCardlessGetInstalmentSchedules::class,
                'name' => 'Get Instalment Schedules',
                'description' => 'Retrieves the details of an existing instalment schedule.

Official GoCardless endpoint: GET /instalment_schedules/{instalment_schedule_id}.',
                'parameters' => [
                    'instalment_schedule_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The instalment schedule id',
                    ],
                ],
            ],
            'gocardless_update_instalment_schedules' => [
                'class' => GoCardlessUpdateInstalmentSchedules::class,
                'name' => 'Update Instalment Schedules',
                'description' => 'Updates an instalment schedule. This accepts only the metadata parameter.

Official GoCardless endpoint: PUT /instalment_schedules/{instalment_schedule_id}.',
                'parameters' => [
                    'instalment_schedule_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The instalment schedule id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_cancel_instalment_schedule' => [
                'class' => GoCardlessCancelInstalmentSchedule::class,
                'name' => 'Cancel Instalment Schedule',
                'description' => 'Immediately cancels an instalment schedule; no further payments will be collected for it. This will fail with a `cancellation_failed` error if the instalment schedule is already cancelled or has completed.

Official GoCardless endpoint: POST /instalment_schedules/{instalment_schedule_id}/actions/cancel.',
                'parameters' => [
                    'instalment_schedule_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The instalment schedule id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_list_institution' => [
                'class' => GoCardlessListInstitution::class,
                'name' => 'List Institution',
                'description' => 'Returns a list of supported institutions.

Official GoCardless endpoint: GET /institutions.',
                'parameters' => [],
            ],
            'gocardless_get_institutions_from_institution' => [
                'class' => GoCardlessGetInstitutionsFromInstitution::class,
                'name' => 'Get Institutions From Institution',
                'description' => 'Returns all institutions valid for a Billing Request. This endpoint is currently supported only for FasterPayments.

Official GoCardless endpoint: GET /billing_requests/{billing_request_id}/institutions.',
                'parameters' => [
                    'billing_request_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The billing request id',
                    ],
                ],
            ],
            'gocardless_logos_branding' => [
                'class' => GoCardlessLogosBranding::class,
                'name' => 'Logos Branding',
                'description' => 'Create a logo associated with a creditor

Official GoCardless endpoint: POST /branding/logos.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_create_mandate' => [
                'class' => GoCardlessCreateMandate::class,
                'name' => 'Create Mandate',
                'description' => 'Creates a new mandate object.

Official GoCardless endpoint: POST /mandates.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_list_mandate' => [
                'class' => GoCardlessListMandate::class,
                'name' => 'List Mandate',
                'description' => 'Returns a [cursor-paginated](#api-usage-cursor-pagination) list of your mandates.

Official GoCardless endpoint: GET /mandates.',
                'parameters' => [],
            ],
            'gocardless_get_mandates' => [
                'class' => GoCardlessGetMandates::class,
                'name' => 'Get Mandates',
                'description' => 'Retrieves the details of an existing mandate.

Official GoCardless endpoint: GET /mandates/{mandate_id}.',
                'parameters' => [
                    'mandate_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The mandate id',
                    ],
                ],
            ],
            'gocardless_update_mandates' => [
                'class' => GoCardlessUpdateMandates::class,
                'name' => 'Update Mandates',
                'description' => 'Updates a mandate object. This accepts only the metadata parameter.

Official GoCardless endpoint: PUT /mandates/{mandate_id}.',
                'parameters' => [
                    'mandate_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The mandate id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_cancel_mandate' => [
                'class' => GoCardlessCancelMandate::class,
                'name' => 'Cancel Mandate',
                'description' => 'Immediately cancels a mandate and all associated cancellable payments. Any metadata supplied to this endpoint will be stored on the mandate cancellation event it causes. This will fail with a `cancellation_failed` error if the mandate is already cancelled.

Official GoCardless endpoint: POST /mandates/{mandate_id}/actions/cancel.',
                'parameters' => [
                    'mandate_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The mandate id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_reinstate_mandate' => [
                'class' => GoCardlessReinstateMandate::class,
                'name' => 'Reinstate Mandate',
                'description' => 'Reinstate a mandate

Official GoCardless endpoint: POST /mandates/{mandate_id}/actions/reinstate.',
                'parameters' => [
                    'mandate_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The mandate id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_create_mandate_import' => [
                'class' => GoCardlessCreateMandateImport::class,
                'name' => 'Create Mandate Import',
                'description' => 'Mandate imports are first created, before mandates are added one-at-a-time, so this endpoint merely signals the start of the import process. Once you\'ve finished adding entries to an import, you should [submit](#mandate-imports-submit-a-mandate-import) it.

Official GoCardless endpoint: POST /mandate_imports.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_get_mandate_imports' => [
                'class' => GoCardlessGetMandateImports::class,
                'name' => 'Get Mandate Imports',
                'description' => 'Returns a single mandate import.

Official GoCardless endpoint: GET /mandate_imports/{mandate_import_id}.',
                'parameters' => [
                    'mandate_import_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The mandate import id',
                    ],
                ],
            ],
            'gocardless_submit_mandate_import' => [
                'class' => GoCardlessSubmitMandateImport::class,
                'name' => 'Submit Mandate Import',
                'description' => 'Submit a mandate import

Official GoCardless endpoint: POST /mandate_imports/{mandate_import_id}/actions/submit.',
                'parameters' => [
                    'mandate_import_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The mandate import id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_cancel_mandate_import' => [
                'class' => GoCardlessCancelMandateImport::class,
                'name' => 'Cancel Mandate Import',
                'description' => 'Cancels the mandate import, which aborts the import process and stops the mandates being set up in GoCardless. Once the import has been cancelled, it can no longer have entries added to it. Mandate imports which have already been submitted or processed cannot be cancelled.

Official GoCardless endpoint: POST /mandate_imports/{mandate_import_id}/actions/cancel.',
                'parameters' => [
                    'mandate_import_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The mandate import id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_create_mandate_import_entry' => [
                'class' => GoCardlessCreateMandateImportEntry::class,
                'name' => 'Create Mandate Import Entry',
                'description' => 'For an existing [mandate import](#core-endpoints-mandate-imports), this endpoint can be used to add individual mandates to be imported into GoCardless. You can add no more than 30,000 rows to a single mandate import. If you attempt to go over this limit, the API will return a `record_limit_exceeded` error.

Official GoCardless endpoint: POST /mandate_import_entries.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_list_mandate_import_entry' => [
                'class' => GoCardlessListMandateImportEntry::class,
                'name' => 'List Mandate Import Entry',
                'description' => 'For an existing mandate import, this endpoint lists all of the entries attached. After a mandate import has been submitted, you can use this endpoint to associate records in your system (using the `record_identifier` that you provided when creating the mandate import).

Official GoCardless endpoint: GET /mandate_import_entries.',
                'parameters' => [],
            ],
            'gocardless_create_mandate_pdf' => [
                'class' => GoCardlessCreateMandatePdf::class,
                'name' => 'Create Mandate PDF',
                'description' => 'Create a mandate PDF

Official GoCardless endpoint: POST /mandate_pdfs.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_list_negative_balance_limit' => [
                'class' => GoCardlessListNegativeBalanceLimit::class,
                'name' => 'List Negative Balance Limit',
                'description' => 'Returns a [cursor-paginated](#api-usage-cursor-pagination) list of negative balance limits.

Official GoCardless endpoint: GET /negative_balance_limits.',
                'parameters' => [],
            ],
            'gocardless_create_outbound_payment' => [
                'class' => GoCardlessCreateOutboundPayment::class,
                'name' => 'Create Outbound Payment',
                'description' => 'Create an outbound payment

Official GoCardless endpoint: POST /outbound_payments.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_list_outbound_payment' => [
                'class' => GoCardlessListOutboundPayment::class,
                'name' => 'List Outbound Payment',
                'description' => 'Returns a [cursor-paginated](#api-usage-cursor-pagination) list of outbound payments.

Official GoCardless endpoint: GET /outbound_payments.',
                'parameters' => [],
            ],
            'gocardless_withdrawal_outbound_payments' => [
                'class' => GoCardlessWithdrawalOutboundPayments::class,
                'name' => 'Withdrawal Outbound Payments',
                'description' => 'Creates an outbound payment to your verified business bank account as the recipient.

Official GoCardless endpoint: POST /outbound_payments/withdrawal.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_cancel_outbound_payment' => [
                'class' => GoCardlessCancelOutboundPayment::class,
                'name' => 'Cancel Outbound Payment',
                'description' => 'Cancels an outbound payment. Only outbound payments with either `verifying`, `pending_approval`, or `scheduled` status can be cancelled. Once an outbound payment is `executing`, the money moving process has begun and cannot be reversed.

Official GoCardless endpoint: POST /outbound_payments/{outbound_payment_id}/actions/cancel.',
                'parameters' => [
                    'outbound_payment_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The outbound payment id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_approve_outbound_payment' => [
                'class' => GoCardlessApproveOutboundPayment::class,
                'name' => 'Approve Outbound Payment',
                'description' => 'Approves an outbound payment. Only outbound payments with the “pending_approval” status can be approved.

Official GoCardless endpoint: POST /outbound_payments/{outbound_payment_id}/actions/approve.',
                'parameters' => [
                    'outbound_payment_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The outbound payment id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_get_outbound_payments' => [
                'class' => GoCardlessGetOutboundPayments::class,
                'name' => 'Get Outbound Payments',
                'description' => 'Fetches an outbound_payment by ID

Official GoCardless endpoint: GET /outbound_payments/{outbound_payment_id}.',
                'parameters' => [
                    'outbound_payment_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The outbound payment id',
                    ],
                ],
            ],
            'gocardless_update_outbound_payments' => [
                'class' => GoCardlessUpdateOutboundPayments::class,
                'name' => 'Update Outbound Payments',
                'description' => 'Updates an outbound payment object. This accepts only the metadata parameter.

Official GoCardless endpoint: PUT /outbound_payments/{outbound_payment_id}.',
                'parameters' => [
                    'outbound_payment_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The outbound payment id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_list_outbound_payments_stats' => [
                'class' => GoCardlessListOutboundPaymentsStats::class,
                'name' => 'List Outbound Payments Stats',
                'description' => 'Retrieve aggregate statistics on outbound payments.

Official GoCardless endpoint: GET /outbound_payments/stats.',
                'parameters' => [],
            ],
            'gocardless_create_outbound_payment_import' => [
                'class' => GoCardlessCreateOutboundPaymentImport::class,
                'name' => 'Create Outbound Payment Import',
                'description' => 'Create an outbound payment import

Official GoCardless endpoint: POST /outbound_payment_imports.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_list_outbound_payment_import' => [
                'class' => GoCardlessListOutboundPaymentImport::class,
                'name' => 'List Outbound Payment Import',
                'description' => 'Returns a [cursor-paginated](#api-usage-cursor-pagination) list of your outbound payment imports.

Official GoCardless endpoint: GET /outbound_payment_imports.',
                'parameters' => [],
            ],
            'gocardless_get_outbound_payment_imports' => [
                'class' => GoCardlessGetOutboundPaymentImports::class,
                'name' => 'Get Outbound Payment Imports',
                'description' => 'Returns a single outbound payment import.

Official GoCardless endpoint: GET /outbound_payment_imports/{outbound_payment_import_id}.',
                'parameters' => [
                    'outbound_payment_import_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The outbound payment import id',
                    ],
                ],
            ],
            'gocardless_list_outbound_payment_import_entry' => [
                'class' => GoCardlessListOutboundPaymentImportEntry::class,
                'name' => 'List Outbound Payment Import Entry',
                'description' => 'Returns a [cursor-paginated](#api-usage-cursor-pagination) list of the entries for a given outbound payment import.

Official GoCardless endpoint: GET /outbound_payment_import_entries.',
                'parameters' => [],
            ],
            'gocardless_get_payer_authorisations' => [
                'class' => GoCardlessGetPayerAuthorisations::class,
                'name' => 'Get Payer Authorisations',
                'description' => 'Retrieves the details of a single existing Payer Authorisation. It can be used for polling the status of a Payer Authorisation. **Deprecated:** Payer Authorisation is legacy API and cannot be used by new integrators. The [Billing Request](#billing-requests) API should be used for any new integrations.

Official GoCardless endpoint: GET /payer_authorisations/{payer_authorisation_id}.',
                'parameters' => [
                    'payer_authorisation_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The payer authorisation id',
                    ],
                ],
            ],
            'gocardless_update_payer_authorisations' => [
                'class' => GoCardlessUpdatePayerAuthorisations::class,
                'name' => 'Update Payer Authorisations',
                'description' => 'Update a Payer Authorisation

Official GoCardless endpoint: PUT /payer_authorisations/{payer_authorisation_id}.',
                'parameters' => [
                    'payer_authorisation_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The payer authorisation id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_create_payer_authorisation' => [
                'class' => GoCardlessCreatePayerAuthorisation::class,
                'name' => 'Create Payer Authorisation',
                'description' => 'Create a Payer Authorisation

Official GoCardless endpoint: POST /payer_authorisations.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_submit_payer_authorisation' => [
                'class' => GoCardlessSubmitPayerAuthorisation::class,
                'name' => 'Submit Payer Authorisation',
                'description' => 'Submit a Payer Authorisation

Official GoCardless endpoint: POST /payer_authorisations/{payer_authorisation_id}/actions/submit.',
                'parameters' => [
                    'payer_authorisation_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The payer authorisation id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_confirm_payer_authorisation' => [
                'class' => GoCardlessConfirmPayerAuthorisation::class,
                'name' => 'Confirm Payer Authorisation',
                'description' => 'Confirm a Payer Authorisation

Official GoCardless endpoint: POST /payer_authorisations/{payer_authorisation_id}/actions/confirm.',
                'parameters' => [
                    'payer_authorisation_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The payer authorisation id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_payer_themes_branding' => [
                'class' => GoCardlessPayerThemesBranding::class,
                'name' => 'Payer Themes Branding',
                'description' => 'Creates a new payer theme associated with a creditor. If a creditor already has payer themes, this will update the existing payer theme linked to the creditor.

Official GoCardless endpoint: POST /branding/payer_themes.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_create_payment' => [
                'class' => GoCardlessCreatePayment::class,
                'name' => 'Create Payment',
                'description' => '<a name="mandate_is_inactive"></a>Creates a new payment object. This fails with a `mandate_is_inactive` error if the linked [mandate](#core-endpoints-mandates) is cancelled or has failed. Payments can be created against mandates with status of: `pending_customer_approval`, `pending_submission`, `submitted`, and `active`.

Official GoCardless endpoint: POST /payments.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_list_payment' => [
                'class' => GoCardlessListPayment::class,
                'name' => 'List Payment',
                'description' => 'Returns a [cursor-paginated](#api-usage-cursor-pagination) list of your payments.

Official GoCardless endpoint: GET /payments.',
                'parameters' => [],
            ],
            'gocardless_get_payments' => [
                'class' => GoCardlessGetPayments::class,
                'name' => 'Get Payments',
                'description' => 'Retrieves the details of a single existing payment.

Official GoCardless endpoint: GET /payments/{payment_id}.',
                'parameters' => [
                    'payment_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The payment id',
                    ],
                ],
            ],
            'gocardless_update_payments' => [
                'class' => GoCardlessUpdatePayments::class,
                'name' => 'Update Payments',
                'description' => 'Updates a payment object. This accepts only the metadata parameter.

Official GoCardless endpoint: PUT /payments/{payment_id}.',
                'parameters' => [
                    'payment_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The payment id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_cancel_payment' => [
                'class' => GoCardlessCancelPayment::class,
                'name' => 'Cancel Payment',
                'description' => 'Cancels the payment if it has not already been submitted to the banks. Any metadata supplied to this endpoint will be stored on the payment cancellation event it causes. This will fail with a `cancellation_failed` error unless the payment\'s status is `pending_submission`.

Official GoCardless endpoint: POST /payments/{payment_id}/actions/cancel.',
                'parameters' => [
                    'payment_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The payment id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_retry_payment' => [
                'class' => GoCardlessRetryPayment::class,
                'name' => 'Retry Payment',
                'description' => 'Retry a payment

Official GoCardless endpoint: POST /payments/{payment_id}/actions/retry.',
                'parameters' => [
                    'payment_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The payment id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_get_payment_accounts' => [
                'class' => GoCardlessGetPaymentAccounts::class,
                'name' => 'Get Payment Accounts',
                'description' => 'Retrieves the details of an existing payment account.

Official GoCardless endpoint: GET /payment_accounts/{payment_account_id}.',
                'parameters' => [
                    'payment_account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The payment account id',
                    ],
                ],
            ],
            'gocardless_list_payment_account' => [
                'class' => GoCardlessListPaymentAccount::class,
                'name' => 'List Payment Account',
                'description' => 'Returns a [cursor-paginated](#api-usage-cursor-pagination) list of your payment accounts.

Official GoCardless endpoint: GET /payment_accounts.',
                'parameters' => [],
            ],
            'gocardless_get_payment_account_transactions' => [
                'class' => GoCardlessGetPaymentAccountTransactions::class,
                'name' => 'Get Payment Account Transactions',
                'description' => 'Retrieves the details of an existing payment account transaction.

Official GoCardless endpoint: GET /payment_account_transactions/{payment_account_transaction_id}.',
                'parameters' => [
                    'payment_account_transaction_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The payment account transaction id',
                    ],
                ],
            ],
            'gocardless_get_transactions_from_payment_account_transaction' => [
                'class' => GoCardlessGetTransactionsFromPaymentAccountTransaction::class,
                'name' => 'Get Transactions From Payment Account Transaction',
                'description' => 'List transactions for a given payment account.

Official GoCardless endpoint: GET /payment_accounts/{payment_account_transaction_id}/transactions.',
                'parameters' => [
                    'payment_account_transaction_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The payment account transaction id',
                    ],
                ],
            ],
            'gocardless_list_payout' => [
                'class' => GoCardlessListPayout::class,
                'name' => 'List Payout',
                'description' => 'Returns a [cursor-paginated](#api-usage-cursor-pagination) list of your payouts.

Official GoCardless endpoint: GET /payouts.',
                'parameters' => [],
            ],
            'gocardless_get_payouts' => [
                'class' => GoCardlessGetPayouts::class,
                'name' => 'Get Payouts',
                'description' => 'Retrieves the details of a single payout. For an example of how to reconcile the transactions in a payout, see [this guide](#events-reconciling-payouts-with-events).

Official GoCardless endpoint: GET /payouts/{payout_id}.',
                'parameters' => [
                    'payout_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The payout id',
                    ],
                ],
            ],
            'gocardless_update_payouts' => [
                'class' => GoCardlessUpdatePayouts::class,
                'name' => 'Update Payouts',
                'description' => 'Updates a payout object. This accepts only the metadata parameter.

Official GoCardless endpoint: PUT /payouts/{payout_id}.',
                'parameters' => [
                    'payout_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The payout id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_list_payout_item' => [
                'class' => GoCardlessListPayoutItem::class,
                'name' => 'List Payout Item',
                'description' => 'Returns a [cursor-paginated](#api-usage-cursor-pagination) list of items in the payout. <strong>This endpoint only serves requests for payouts created in the last 6 months. Requests for older payouts will return an HTTP status <code>410 Gone</code>.</strong>

Official GoCardless endpoint: GET /payout_items.',
                'parameters' => [],
            ],
            'gocardless_create_redirect_flow' => [
                'class' => GoCardlessCreateRedirectFlow::class,
                'name' => 'Create Redirect Flow',
                'description' => 'Creates a redirect flow object which can then be used to redirect your customer to the GoCardless hosted payment pages. **Deprecated:** Redirect Flows are legacy APIs and cannot be used by new integrators. The [Billing Request flow](#billing-requests) API should be used for your payment flows.

Official GoCardless endpoint: POST /redirect_flows.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_get_redirect_flows' => [
                'class' => GoCardlessGetRedirectFlows::class,
                'name' => 'Get Redirect Flows',
                'description' => 'Returns all details about a single redirect flow **Deprecated:** Redirect Flows are legacy APIs and cannot be used by new integrators. The [Billing Request flow](#billing-requests) API should be used for your payment flows.

Official GoCardless endpoint: GET /redirect_flows/{redirect_flow_id}.',
                'parameters' => [
                    'redirect_flow_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The redirect flow id',
                    ],
                ],
            ],
            'gocardless_complete_redirect_flow' => [
                'class' => GoCardlessCompleteRedirectFlow::class,
                'name' => 'Complete Redirect Flow',
                'description' => 'Complete a redirect flow

Official GoCardless endpoint: POST /redirect_flows/{redirect_flow_id}/actions/complete.',
                'parameters' => [
                    'redirect_flow_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The redirect flow id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_create_refund' => [
                'class' => GoCardlessCreateRefund::class,
                'name' => 'Create Refund',
                'description' => 'Create a refund

Official GoCardless endpoint: POST /refunds.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_list_refund' => [
                'class' => GoCardlessListRefund::class,
                'name' => 'List Refund',
                'description' => 'Returns a [cursor-paginated](#api-usage-cursor-pagination) list of your refunds.

Official GoCardless endpoint: GET /refunds.',
                'parameters' => [],
            ],
            'gocardless_get_refunds' => [
                'class' => GoCardlessGetRefunds::class,
                'name' => 'Get Refunds',
                'description' => 'Retrieves all details for a single refund

Official GoCardless endpoint: GET /refunds/{refund_id}.',
                'parameters' => [
                    'refund_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The refund id',
                    ],
                ],
            ],
            'gocardless_update_refunds' => [
                'class' => GoCardlessUpdateRefunds::class,
                'name' => 'Update Refunds',
                'description' => 'Updates a refund object.

Official GoCardless endpoint: PUT /refunds/{refund_id}.',
                'parameters' => [
                    'refund_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The refund id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_run_scenario_simulator' => [
                'class' => GoCardlessRunScenarioSimulator::class,
                'name' => 'Run Scenario Simulator',
                'description' => 'Runs the specific scenario simulator against the specific resource

Official GoCardless endpoint: POST /scenario_simulators/{scenario_simulator_id}/actions/run.',
                'parameters' => [
                    'scenario_simulator_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The scenario simulator id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_create_scheme_identifier' => [
                'class' => GoCardlessCreateSchemeIdentifier::class,
                'name' => 'Create Scheme Identifier',
                'description' => 'Create a scheme identifier

Official GoCardless endpoint: POST /scheme_identifiers.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_list_scheme_identifier' => [
                'class' => GoCardlessListSchemeIdentifier::class,
                'name' => 'List Scheme Identifier',
                'description' => 'Returns a [cursor-paginated](#api-usage-cursor-pagination) list of your scheme identifiers.

Official GoCardless endpoint: GET /scheme_identifiers.',
                'parameters' => [],
            ],
            'gocardless_get_scheme_identifiers' => [
                'class' => GoCardlessGetSchemeIdentifiers::class,
                'name' => 'Get Scheme Identifiers',
                'description' => 'Retrieves the details of an existing scheme identifier.

Official GoCardless endpoint: GET /scheme_identifiers/{scheme_identifier_id}.',
                'parameters' => [
                    'scheme_identifier_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The scheme identifier id',
                    ],
                ],
            ],
            'gocardless_create_subscription' => [
                'class' => GoCardlessCreateSubscription::class,
                'name' => 'Create Subscription',
                'description' => 'Creates a new subscription object

Official GoCardless endpoint: POST /subscriptions.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_list_subscription' => [
                'class' => GoCardlessListSubscription::class,
                'name' => 'List Subscription',
                'description' => 'Returns a [cursor-paginated](#api-usage-cursor-pagination) list of your subscriptions. Please note if the subscriptions are related to customers who have been removed, they will not be shown in the response.

Official GoCardless endpoint: GET /subscriptions.',
                'parameters' => [],
            ],
            'gocardless_get_subscriptions' => [
                'class' => GoCardlessGetSubscriptions::class,
                'name' => 'Get Subscriptions',
                'description' => 'Retrieves the details of a single subscription.

Official GoCardless endpoint: GET /subscriptions/{subscription_id}.',
                'parameters' => [
                    'subscription_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The subscription id',
                    ],
                ],
            ],
            'gocardless_update_subscriptions' => [
                'class' => GoCardlessUpdateSubscriptions::class,
                'name' => 'Update Subscriptions',
                'description' => 'Update a subscription

Official GoCardless endpoint: PUT /subscriptions/{subscription_id}.',
                'parameters' => [
                    'subscription_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The subscription id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_pause_subscription' => [
                'class' => GoCardlessPauseSubscription::class,
                'name' => 'Pause Subscription',
                'description' => 'Pause a subscription

Official GoCardless endpoint: POST /subscriptions/{subscription_id}/actions/pause.',
                'parameters' => [
                    'subscription_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The subscription id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_resume_subscription' => [
                'class' => GoCardlessResumeSubscription::class,
                'name' => 'Resume Subscription',
                'description' => 'Resume a subscription

Official GoCardless endpoint: POST /subscriptions/{subscription_id}/actions/resume.',
                'parameters' => [
                    'subscription_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The subscription id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_cancel_subscription' => [
                'class' => GoCardlessCancelSubscription::class,
                'name' => 'Cancel Subscription',
                'description' => 'Immediately cancels a subscription; no more payments will be created under it. Any metadata supplied to this endpoint will be stored on the payment cancellation event it causes. This will fail with a cancellation_failed error if the subscription is already cancelled or finished.

Official GoCardless endpoint: POST /subscriptions/{subscription_id}/actions/cancel.',
                'parameters' => [
                    'subscription_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The subscription id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_list_tax_rate' => [
                'class' => GoCardlessListTaxRate::class,
                'name' => 'List Tax Rate',
                'description' => 'Returns a [cursor-paginated](#api-usage-cursor-pagination) list of all tax rates.

Official GoCardless endpoint: GET /tax_rates.',
                'parameters' => [],
            ],
            'gocardless_get_tax_rates' => [
                'class' => GoCardlessGetTaxRates::class,
                'name' => 'Get Tax Rates',
                'description' => 'Retrieves the details of a tax rate.

Official GoCardless endpoint: GET /tax_rates/{tax_rate_id}.',
                'parameters' => [
                    'tax_rate_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The tax rate id',
                    ],
                ],
            ],
            'gocardless_get_transferred_mandates' => [
                'class' => GoCardlessGetTransferredMandates::class,
                'name' => 'Get Transferred Mandates',
                'description' => 'Returns new customer bank details for a mandate that\'s been recently transferred

Official GoCardless endpoint: GET /transferred_mandates/{mandate_id}.',
                'parameters' => [
                    'mandate_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The mandate id',
                    ],
                ],
            ],
            'gocardless_create_verification_detail' => [
                'class' => GoCardlessCreateVerificationDetail::class,
                'name' => 'Create Verification Detail',
                'description' => 'Creates a new verification detail

Official GoCardless endpoint: POST /verification_details.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
            'gocardless_list_verification_detail' => [
                'class' => GoCardlessListVerificationDetail::class,
                'name' => 'List Verification Detail',
                'description' => 'Returns a list of verification details belonging to a creditor.

Official GoCardless endpoint: GET /verification_details.',
                'parameters' => [],
            ],
            'gocardless_list_webhook' => [
                'class' => GoCardlessListWebhook::class,
                'name' => 'List Webhook',
                'description' => 'Returns a [cursor-paginated](#api-usage-cursor-pagination) list of your webhooks.

Official GoCardless endpoint: GET /webhooks.',
                'parameters' => [],
            ],
            'gocardless_get_webhooks' => [
                'class' => GoCardlessGetWebhooks::class,
                'name' => 'Get Webhooks',
                'description' => 'Retrieves the details of an existing webhook.

Official GoCardless endpoint: GET /webhooks/{webhook_id}.',
                'parameters' => [
                    'webhook_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The webhook id',
                    ],
                ],
            ],
            'gocardless_retry_webhook' => [
                'class' => GoCardlessRetryWebhook::class,
                'name' => 'Retry Webhook',
                'description' => 'Requests for a previous webhook to be sent again

Official GoCardless endpoint: POST /webhooks/{webhook_id}/actions/retry.',
                'parameters' => [
                    'webhook_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The webhook id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GoCardless OpenAPI schema.',
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
                    ],
                ],
            ],
        ]; }

    /** @param  array<string, mixed>  $context  Runtime account context. */
    public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); }

    /** @param  array<string, mixed>  $context  Runtime account context. */
    private function resolveService(array $context = []): GoCardlessService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);
            return new GoCardlessService(apiKey: $creds->get('gocardless', 'api_key', '', $account), baseUrl: $creds->get('gocardless', 'url', 'https://api.gocardless.com', $account), apiVersion: $creds->get('gocardless', 'api_version', '2015-07-06', $account));
        }

        return app(GoCardlessService::class);
    }

    public function luaDocsPath(): ?string { return __DIR__ . '/../lua-docs/gocardless.md'; }
    public function isIntegration(): bool { return true; }
}
