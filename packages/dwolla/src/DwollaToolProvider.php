<?php

namespace OpenCompany\Integrations\Dwolla;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Dwolla\Tools\DwollaCreateApplicationAccessToken;
use OpenCompany\Integrations\Dwolla\Tools\DwollaGetRoot;
use OpenCompany\Integrations\Dwolla\Tools\DwollaGetAccount;
use OpenCompany\Integrations\Dwolla\Tools\DwollaCreateFundingSource;
use OpenCompany\Integrations\Dwolla\Tools\DwollaListFundingSources;
use OpenCompany\Integrations\Dwolla\Tools\DwollaListAndSearchTransfers;
use OpenCompany\Integrations\Dwolla\Tools\DwollaListMassPayments;
use OpenCompany\Integrations\Dwolla\Tools\DwollaListAndSearchCustomers;
use OpenCompany\Integrations\Dwolla\Tools\DwollaCreateCustomer;
use OpenCompany\Integrations\Dwolla\Tools\DwollaGetCustomer;
use OpenCompany\Integrations\Dwolla\Tools\DwollaUpdate;
use OpenCompany\Integrations\Dwolla\Tools\DwollaListBusinessClassifications;
use OpenCompany\Integrations\Dwolla\Tools\DwollaRetrieveBusinessClassification;
use OpenCompany\Integrations\Dwolla\Tools\DwollaListBeneficialOwnersForCustomer;
use OpenCompany\Integrations\Dwolla\Tools\DwollaCreateBeneficialOwnerForCustomer;
use OpenCompany\Integrations\Dwolla\Tools\DwollaRetrieveBeneficialOwner;
use OpenCompany\Integrations\Dwolla\Tools\DwollaUpdateBeneficialOwner;
use OpenCompany\Integrations\Dwolla\Tools\DwollaDeleteBeneficialOwner;
use OpenCompany\Integrations\Dwolla\Tools\DwollaGetBeneficialOwnershipStatusForCustomer;
use OpenCompany\Integrations\Dwolla\Tools\DwollaCertifyBeneficialOwnershipForCustomer;
use OpenCompany\Integrations\Dwolla\Tools\DwollaListCustomerDocuments;
use OpenCompany\Integrations\Dwolla\Tools\DwollaCreateCustomerDocument;
use OpenCompany\Integrations\Dwolla\Tools\DwollaListBeneficialOwnerDocuments;
use OpenCompany\Integrations\Dwolla\Tools\DwollaCreateBeneficialOwnerDocument;
use OpenCompany\Integrations\Dwolla\Tools\DwollaRetrieveDocument;
use OpenCompany\Integrations\Dwolla\Tools\DwollaInitiateKbaForCustomer;
use OpenCompany\Integrations\Dwolla\Tools\DwollaGetKbaQuestions;
use OpenCompany\Integrations\Dwolla\Tools\DwollaVerifyKbaQuestions;
use OpenCompany\Integrations\Dwolla\Tools\DwollaListCustomerFundingSources;
use OpenCompany\Integrations\Dwolla\Tools\DwollaCreateCustomerFundingSource;
use OpenCompany\Integrations\Dwolla\Tools\DwollaGetFundingSource;
use OpenCompany\Integrations\Dwolla\Tools\DwollaUpdateOrRemoveFundingSource;
use OpenCompany\Integrations\Dwolla\Tools\DwollaGetMicroDeposits;
use OpenCompany\Integrations\Dwolla\Tools\DwollaInitiateOrVerifyMicroDeposits;
use OpenCompany\Integrations\Dwolla\Tools\DwollaGetFundingSourceBalance;
use OpenCompany\Integrations\Dwolla\Tools\DwollaGetVanRouting;
use OpenCompany\Integrations\Dwolla\Tools\DwollaCreateOnDemandTransferAuthorization;
use OpenCompany\Integrations\Dwolla\Tools\DwollaInitiateTransfer;
use OpenCompany\Integrations\Dwolla\Tools\DwollaGetTransfer;
use OpenCompany\Integrations\Dwolla\Tools\DwollaCancelTransfer;
use OpenCompany\Integrations\Dwolla\Tools\DwollaListCustomerTransfers;
use OpenCompany\Integrations\Dwolla\Tools\DwollaListTransferFees;
use OpenCompany\Integrations\Dwolla\Tools\DwollaGetTransferFailureReason;
use OpenCompany\Integrations\Dwolla\Tools\DwollaInitiateMassPayment;
use OpenCompany\Integrations\Dwolla\Tools\DwollaGetMassPayment;
use OpenCompany\Integrations\Dwolla\Tools\DwollaUpdateMassPayment;
use OpenCompany\Integrations\Dwolla\Tools\DwollaListMassPaymentItems;
use OpenCompany\Integrations\Dwolla\Tools\DwollaGetMassPaymentItem;
use OpenCompany\Integrations\Dwolla\Tools\DwollaListCustomerMassPayments;
use OpenCompany\Integrations\Dwolla\Tools\DwollaGetLabel;
use OpenCompany\Integrations\Dwolla\Tools\DwollaRemoveLabel;
use OpenCompany\Integrations\Dwolla\Tools\DwollaListCustomerLabels;
use OpenCompany\Integrations\Dwolla\Tools\DwollaCreateCustomerLabel;
use OpenCompany\Integrations\Dwolla\Tools\DwollaListLabelLedgerEntries;
use OpenCompany\Integrations\Dwolla\Tools\DwollaCreateLabelLedgerEntry;
use OpenCompany\Integrations\Dwolla\Tools\DwollaGetLabelLedgerEntry;
use OpenCompany\Integrations\Dwolla\Tools\DwollaCreateLabelReallocation;
use OpenCompany\Integrations\Dwolla\Tools\DwollaRetrieveLabelReallocation;
use OpenCompany\Integrations\Dwolla\Tools\DwollaListEvents;
use OpenCompany\Integrations\Dwolla\Tools\DwollaGetEvent;
use OpenCompany\Integrations\Dwolla\Tools\DwollaListWebhookSubscriptions;
use OpenCompany\Integrations\Dwolla\Tools\DwollaCreateWebhookSubscription;
use OpenCompany\Integrations\Dwolla\Tools\DwollaGetWebhookSubscription;
use OpenCompany\Integrations\Dwolla\Tools\DwollaUpdateWebhookSubscription;
use OpenCompany\Integrations\Dwolla\Tools\DwollaDelete;
use OpenCompany\Integrations\Dwolla\Tools\DwollaListWebhooks;
use OpenCompany\Integrations\Dwolla\Tools\DwollaGetWebhook;
use OpenCompany\Integrations\Dwolla\Tools\DwollaListWebhookRetries;
use OpenCompany\Integrations\Dwolla\Tools\DwollaRetryWebhook;
use OpenCompany\Integrations\Dwolla\Tools\DwollaSimulateBankTransferProcessing;
use OpenCompany\Integrations\Dwolla\Tools\DwollaListExchangePartners;
use OpenCompany\Integrations\Dwolla\Tools\DwollaGetExchangePartner;
use OpenCompany\Integrations\Dwolla\Tools\DwollaListAccountExchanges;
use OpenCompany\Integrations\Dwolla\Tools\DwollaCreateAccountExchange;
use OpenCompany\Integrations\Dwolla\Tools\DwollaGetExchange;
use OpenCompany\Integrations\Dwolla\Tools\DwollaListCustomerExchanges;
use OpenCompany\Integrations\Dwolla\Tools\DwollaCreateCustomerExchange;
use OpenCompany\Integrations\Dwolla\Tools\DwollaCreateCustomerExchangeSession;
use OpenCompany\Integrations\Dwolla\Tools\DwollaRetrieveCustomerExchangeSession;
use OpenCompany\Integrations\Dwolla\Tools\DwollaCreateReAuthExchangeSession;
use OpenCompany\Integrations\Dwolla\Tools\DwollaListAvailableExchangeConnections;
use OpenCompany\Integrations\Dwolla\Tools\DwollaCreateClientToken;

/**
 * Tool catalog and configuration metadata for Dwolla.
 *
 * Exposes the official Dwolla OpenAPI operation set as endpoint-specific tools
 * and resolves account-specific access tokens for multi-account hosts.
 */
class DwollaToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /** @return array<string, mixed> */
    public function integrationCapabilities(): array
    {
        return ['auth' => ['strategy' => 'oauth_client_credentials', 'legacy_auth_type' => 'api_key', 'credential_mode' => 'secret', 'setup_flows' => ['manual_secret'], 'requires_browser_for_setup' => false, 'refreshable' => true, 'token_keys' => ['access_token'], 'notes' => ['Dwolla uses OAuth client credentials. Runtime tools use Authorization: Bearer <access_token>; dwolla_create_application_access_token uses Basic client credentials.']], 'host_availability' => ['web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'], 'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal']], 'runtime_requirements' => [], 'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true]];
    }

    public function appName(): string { return 'dwolla'; }
    public function appMeta(): array { return ['label' => 'Dwolla', 'description' => 'Customers, funding sources, transfers, mass payments, webhooks, documents, beneficial owners, and sandbox simulations', 'icon' => 'ph:bank', 'logo' => 'ph:bank']; }
    public function integrationMeta(): array { return ['name' => 'Dwolla', 'description' => 'Manage Dwolla customers, beneficial owners, documents, funding sources, transfers, mass payments, labels, events, webhook subscriptions, exchanges, KBA, and sandbox simulations.', 'icon' => 'ph:bank', 'logo' => 'ph:bank', 'category' => 'data', 'badge' => 'verified', 'docs_url' => 'https://developers.dwolla.com/']; }
    public function configSchema(): array { return [['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'placeholder' => 'Dwolla OAuth access token', 'hint' => 'Sent as Authorization: Bearer <access_token> for API calls.', 'required' => false], ['key' => 'client_id', 'type' => 'text', 'label' => 'Client ID', 'placeholder' => 'Dwolla client ID', 'hint' => 'Used by dwolla_create_application_access_token.', 'required' => false], ['key' => 'client_secret', 'type' => 'secret', 'label' => 'Client Secret', 'placeholder' => 'Dwolla client secret', 'hint' => 'Used by dwolla_create_application_access_token.', 'required' => false], ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://api-sandbox.dwolla.com', 'default' => 'https://api-sandbox.dwolla.com']]; }

    /** @param  array<string, mixed>  $config  Credential and endpoint settings. @return array{success: bool, message?: string, error?: string} */
    public function testConnection(array $config): array
    {
        $accessToken = (string) ($config['access_token'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api-sandbox.dwolla.com'), '/');
        if ($accessToken === '') { return ['success' => false, 'error' => 'Dwolla access token is required for connection testing.']; }

        try {
            $response = Http::withHeaders(['Authorization' => 'Bearer ' . $accessToken, 'Accept' => 'application/vnd.dwolla.v1.hal+json'])->timeout(10)->get($baseUrl . '/');
            if (!$response->successful()) { return ['success' => false, 'error' => 'Dwolla API returned HTTP ' . $response->status() . '.']; }
            return ['success' => true, 'message' => 'Connected to Dwolla at ' . $baseUrl . '.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array { return ['access_token' => 'nullable|string', 'client_id' => 'nullable|string', 'client_secret' => 'nullable|string', 'url' => 'nullable|url']; }
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => false],
            ['key' => 'client_id', 'type' => 'text', 'label' => 'Client ID', 'required' => false],
            ['key' => 'client_secret', 'type' => 'secret', 'label' => 'Client Secret', 'required' => false],
        ];
    }
    public function tools(): array { return [
            'dwolla_create_application_access_token' => [
                'class' => DwollaCreateApplicationAccessToken::class,
                'name' => 'Create Application Access Token',
                'description' => 'Generate an application access token using OAuth 2.0 client credentials flow for server-to-server authentication. Requires client ID and secret sent via Basic authentication header with grant_type=client_credentials in the request body. Returns a bearer access token with expiration time for authenticating API requests scoped to your application. Essential for secure API access.

Official Dwolla endpoint: POST /token.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Dwolla OpenAPI schema.',
                    ],
                ],
            ],
            'dwolla_get_root' => [
                'class' => DwollaGetRoot::class,
                'name' => 'Get Root',
                'description' => 'Retrieve the API root entry point to discover available resources and endpoints based on your OAuth access token permissions. Returns HAL+JSON with navigation links to accessible resources including accounts, customers, events, and webhook subscriptions depending on token scope. Essential for API exploration, dynamic resource discovery, and building adaptive client applications that respond to available permissions.

Official Dwolla endpoint: GET /.',
                'parameters' => [
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                ],
            ],
            'dwolla_get_account' => [
                'class' => DwollaGetAccount::class,
                'name' => 'Get Account',
                'description' => 'Returns basic account information for your authorized Main Dwolla Account, including account ID, name, and links to related resources such as funding sources, transfers, and customers.

Official Dwolla endpoint: GET /accounts/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account\'s unique identifier',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                ],
            ],
            'dwolla_create_funding_source' => [
                'class' => DwollaCreateFundingSource::class,
                'name' => 'Create Funding Source',
                'description' => 'Create a funding source by adding a bank account to a Main Dwolla Account. This endpoint allows you to connect a checking or savings account using either manual bank account details or an exchange resource. For more information about funding sources, see the [Funding Sources API Reference](https://developers.dwolla.com/docs/api-reference/funding-sources).

Official Dwolla endpoint: POST /funding-sources.',
                'parameters' => [
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Dwolla OpenAPI schema.',
                    ],
                ],
            ],
            'dwolla_list_funding_sources' => [
                'class' => DwollaListFundingSources::class,
                'name' => 'List Funding Sources',
                'description' => 'Get a list of all funding sources associated with a specific Main Dwolla Account. This endpoint returns both bank accounts and balance funding sources, with detailed information about each funding source\'s status, type, and available processing channels.

Official Dwolla endpoint: GET /accounts/{id}/funding-sources.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account\'s unique identifier',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                    'removed' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Filter removed funding sources. Boolean value. Defaults to `true`',
                    ],
                ],
            ],
            'dwolla_list_and_search_transfers' => [
                'class' => DwollaListAndSearchTransfers::class,
                'name' => 'List And Search Transfers',
                'description' => 'Returns a paginated, searchable list of transfers associated with the specified Main Dwolla account. Supports advanced filtering by amount range, date range, transfer status, and correlation ID. Results are limited to 10,000 transfers per query; use date range filters for historical data beyond this limit.

Official Dwolla endpoint: GET /accounts/{id}/transfers.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account\'s unique identifier',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                    'search' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'A string to search on fields `firstName`, `lastName`, `email`, `businessName`, Customer ID, and Account ID',
                    ],
                    'start_amount' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Only include transactions with an amount equal to or greater than `startAmount`',
                    ],
                    'end_amount' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Only include transactions with an amount equal to or less than `endAmount`',
                    ],
                    'start_date' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Only include transactions created after this date. ISO-8601 format `YYYY-MM-DD`',
                    ],
                    'end_date' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Only include transactions created before this date. ISO-8601 format `YYYY-MM-DD`',
                    ],
                    'status' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Filter on transaction status. Possible values are `pending`, `processed`, `failed`, or `cancelled`',
                    ],
                    'correlation_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'A string value to search on if `correlationId` was specified for a transaction',
                    ],
                    'limit' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Number of search results to return. Defaults to 25',
                    ],
                    'offset' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Number of search results to skip. Use for pagination',
                    ],
                ],
            ],
            'dwolla_list_mass_payments' => [
                'class' => DwollaListMassPayments::class,
                'name' => 'List Mass Payments',
                'description' => 'Returns a paginated list of mass payments created by your Main Dwolla account. Results are sorted by creation date in descending order (newest first) and can be filtered by correlation ID.

Official Dwolla endpoint: GET /accounts/{id}/mass-payments.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Account\'s unique identifier',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                    'limit' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Maximum number of results to return',
                    ],
                    'offset' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'How many results to skip.',
                    ],
                    'correlation_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Correlation ID to search by.',
                    ],
                ],
            ],
            'dwolla_list_and_search_customers' => [
                'class' => DwollaListAndSearchCustomers::class,
                'name' => 'List And Search Customers',
                'description' => 'Returns a paginated list of customers sorted by creation date. Supports fuzzy search across customer names, business names, and email addresses, plus exact filtering by email and verification status. Default limit is 25 customers per page, maximum 200.

Official Dwolla endpoint: GET /customers.',
                'parameters' => [
                    'limit' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'How many results to return',
                    ],
                    'offset' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'How many results to skip',
                    ],
                    'search' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Searches on certain fields',
                    ],
                    'status' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Filter by customer status',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                ],
            ],
            'dwolla_create_customer' => [
                'class' => DwollaCreateCustomer::class,
                'name' => 'Create Customer',
                'description' => 'Creates a new customer with different verification levels and capabilities. Supports personal verified customers (individuals), business verified customers (businesses), unverified customers, and receive-only users. Customer type determines transaction limits, verification requirements, and available features.

Official Dwolla endpoint: POST /customers.',
                'parameters' => [
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Dwolla OpenAPI schema.',
                    ],
                ],
            ],
            'dwolla_get_customer' => [
                'class' => DwollaGetCustomer::class,
                'name' => 'Get Customer',
                'description' => 'Retrieve identifying information for a specific customer. The returned data varies by customer type - verified customers include contact details, address information, and verification status, while unverified customers and receive-only users contain basic contact information only.

Official Dwolla endpoint: GET /customers/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Customer unique identifier',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                ],
            ],
            'dwolla_update' => [
                'class' => DwollaUpdate::class,
                'name' => 'Update',
                'description' => 'Update Customer information, upgrade an unverified Customer to a verified Customer, suspend a Customer, deactivate a Customer, reactivate a Customer, and update a verified Customer\'s information to retry verification.

Official Dwolla endpoint: POST /customers/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Customer unique identifier',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Dwolla OpenAPI schema.',
                    ],
                ],
            ],
            'dwolla_list_business_classifications' => [
                'class' => DwollaListBusinessClassifications::class,
                'name' => 'List Business Classifications',
                'description' => 'Returns a directory of business and industry classifications required for creating business verified customers. Each business classification contains multiple industry classifications. The industry classification ID must be provided in the businessClassification parameter during business customer creation for verification.

Official Dwolla endpoint: GET /business-classifications.',
                'parameters' => [
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                ],
            ],
            'dwolla_retrieve_business_classification' => [
                'class' => DwollaRetrieveBusinessClassification::class,
                'name' => 'Retrieve Business Classification',
                'description' => 'Returns a specific business classification with its embedded industry classifications. Use this endpoint to browse available industry options within a business category and obtain the industry classification ID required for the businessClassification parameter when creating business verified customers.

Official Dwolla endpoint: GET /business-classifications/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'business classification unique identifier',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                ],
            ],
            'dwolla_list_beneficial_owners_for_customer' => [
                'class' => DwollaListBeneficialOwnersForCustomer::class,
                'name' => 'List Beneficial Owners For Customer',
                'description' => 'Returns all beneficial owners associated with a business verified customer. Beneficial owners are individuals who directly or indirectly own 25% or more of the company\'s equity. Includes personal information, verification status, and address details for each owner.

Official Dwolla endpoint: GET /customers/{id}/beneficial-owners.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Customer unique identifier',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                ],
            ],
            'dwolla_create_beneficial_owner_for_customer' => [
                'class' => DwollaCreateBeneficialOwnerForCustomer::class,
                'name' => 'Create Beneficial Owner For Customer',
                'description' => 'Creates a new beneficial owner for a business verified customer. Beneficial owners are individuals who own 25% or more of the company\'s equity. Requires personal information, address, and SSN or passport for identity verification.

Official Dwolla endpoint: POST /customers/{id}/beneficial-owners.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Customer ID for which to create a Beneficial Owner',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Dwolla OpenAPI schema.',
                    ],
                ],
            ],
            'dwolla_retrieve_beneficial_owner' => [
                'class' => DwollaRetrieveBeneficialOwner::class,
                'name' => 'Retrieve Beneficial Owner',
                'description' => 'Returns detailed information for a specific beneficial owner, including personal information, address, and verification status. The verification status indicates the owner\'s identity verification progress and affects the business customer\'s transaction capabilities.

Official Dwolla endpoint: GET /beneficial-owners/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Beneficial owner unique identifier',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                ],
            ],
            'dwolla_update_beneficial_owner' => [
                'class' => DwollaUpdateBeneficialOwner::class,
                'name' => 'Update Beneficial Owner',
                'description' => 'Updates a beneficial owner\'s information to retry verification when their status is "incomplete". Only beneficial owners with incomplete verification status can be updated. Used to correct information that caused initial verification to fail.

Official Dwolla endpoint: POST /beneficial-owners/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Beneficial owner unique identifier',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Dwolla OpenAPI schema.',
                    ],
                ],
            ],
            'dwolla_delete_beneficial_owner' => [
                'class' => DwollaDeleteBeneficialOwner::class,
                'name' => 'Delete Beneficial Owner',
                'description' => 'Permanently removes a beneficial owner from a business customer. This action is irreversible and the beneficial owner cannot be retrieved after removal. Removing a beneficial owner will change the customer\'s certification status to "recertify".

Official Dwolla endpoint: DELETE /beneficial-owners/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Beneficial owner unique identifier',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                ],
            ],
            'dwolla_get_beneficial_ownership_status_for_customer' => [
                'class' => DwollaGetBeneficialOwnershipStatusForCustomer::class,
                'name' => 'Get Beneficial Ownership Status For Customer',
                'description' => 'Returns the certification status of beneficial ownership for a business verified customer. Status indicates whether beneficial owner information has been certified and affects the customer\'s ability to send funds. Possible values include uncertified, certified, and recertify.

Official Dwolla endpoint: GET /customers/{id}/beneficial-ownership.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Customer unique identifier',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                ],
            ],
            'dwolla_certify_beneficial_ownership_for_customer' => [
                'class' => DwollaCertifyBeneficialOwnershipForCustomer::class,
                'name' => 'Certify Beneficial Ownership For Customer',
                'description' => 'Updates the beneficial ownership certification status to "certified", confirming that all beneficial owner information is accurate and complete. This action enables the business customer to send funds and is required to complete the verification process.

Official Dwolla endpoint: POST /customers/{id}/beneficial-ownership.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Customer unique identifier',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Dwolla OpenAPI schema.',
                    ],
                ],
            ],
            'dwolla_list_customer_documents' => [
                'class' => DwollaListCustomerDocuments::class,
                'name' => 'List Customer Documents',
                'description' => 'Returns all identity verification documents submitted for a customer. Includes document status, verification results, document type (passport, driver\'s license, etc.), and failure reasons if verification was rejected. Used to track document submission and verification progress during the business verification process.

Official Dwolla endpoint: GET /customers/{id}/documents.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'customer unique identifier',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                ],
            ],
            'dwolla_create_customer_document' => [
                'class' => DwollaCreateCustomerDocument::class,
                'name' => 'Create Customer Document',
                'description' => 'Uploads an identity verification document for a customer using multipart form-data. Required when a customer has "document" status during the verification process.

Official Dwolla endpoint: POST /customers/{id}/documents.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'customer unique identifier',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Dwolla OpenAPI schema.',
                    ],
                ],
            ],
            'dwolla_list_beneficial_owner_documents' => [
                'class' => DwollaListBeneficialOwnerDocuments::class,
                'name' => 'List Beneficial Owner Documents',
                'description' => 'Returns all identity verification documents submitted for a beneficial owner. Includes document status, verification results, document type (passport, driver\'s license, etc.), and failure reasons if verification was rejected. Used to track document submission and verification progress during the business verification process.

Official Dwolla endpoint: GET /beneficial-owners/{id}/documents.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'beneficial owner unique identifier',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                ],
            ],
            'dwolla_create_beneficial_owner_document' => [
                'class' => DwollaCreateBeneficialOwnerDocument::class,
                'name' => 'Create Beneficial Owner Document',
                'description' => 'Uploads an identity verification document for a beneficial owner using multipart form-data. Required when a beneficial owner has "document" status during the business verification process.

Official Dwolla endpoint: POST /beneficial-owners/{id}/documents.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'beneficial owner unique identifier',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Dwolla OpenAPI schema.',
                    ],
                ],
            ],
            'dwolla_retrieve_document' => [
                'class' => DwollaRetrieveDocument::class,
                'name' => 'Retrieve Document',
                'description' => 'Returns detailed information about a specific identity verification document, including its status, type, and verification results. Used to track document submission and verification progress during the business verification process.

Official Dwolla endpoint: GET /documents/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Document unique identifier',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                ],
            ],
            'dwolla_initiate_kba_for_customer' => [
                'class' => DwollaInitiateKbaForCustomer::class,
                'name' => 'Initiate KBA For Customer',
                'description' => 'Creates a new KBA (Knowledge-Based Authentication) session for a personal Verified Customer. Returns a KBA identifier that represents the session and is used to retrieve authentication questions for customer verification.

Official Dwolla endpoint: POST /customers/{id}/kba.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the Customer for initiating a KBA session',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Dwolla OpenAPI schema.',
                    ],
                ],
            ],
            'dwolla_get_kba_questions' => [
                'class' => DwollaGetKbaQuestions::class,
                'name' => 'Get KBA Questions',
                'description' => 'Returns the KBA questions for a specific KBA session. The questions are used to verify the customer\'s identity during the KBA process.

Official Dwolla endpoint: GET /kba/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the KBA session to retrieve questions for',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                ],
            ],
            'dwolla_verify_kba_questions' => [
                'class' => DwollaVerifyKbaQuestions::class,
                'name' => 'Verify KBA Questions',
                'description' => 'Submits customer answers to KBA questions for identity verification. Requires four question-answer pairs with questionId and answerId values. Returns verification status indicating whether the customer passed or failed the KBA authentication.

Official Dwolla endpoint: POST /kba/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The id of the KBA session to verify questions for.',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Dwolla OpenAPI schema.',
                    ],
                ],
            ],
            'dwolla_list_customer_funding_sources' => [
                'class' => DwollaListCustomerFundingSources::class,
                'name' => 'List Customer Funding Sources',
                'description' => 'Returns all funding sources for a customer, including bank accounts, debit card funding sources, and Dwolla balance (verified customers only). Shows verification status, limited account details, and creation dates. Card funding sources include masked card information. Supports filtering to exclude removed funding sources using the removed parameter.

Official Dwolla endpoint: GET /customers/{id}/funding-sources.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Customer\'s unique identifier',
                    ],
                    'removed' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Filter removed funding sources. Boolean value. Defaults to `true`',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                ],
            ],
            'dwolla_create_customer_funding_source' => [
                'class' => DwollaCreateCustomerFundingSource::class,
                'name' => 'Create Customer Funding Source',
                'description' => 'Creates a bank account or debit card funding source for a customer. Supports multiple methods including manual entry with routing/account numbers, instant verification using existing open banking connections, debit card addition via Exchange, and virtual account numbers. Bank funding sources require verification before transfers can be initiated.

Official Dwolla endpoint: POST /customers/{id}/funding-sources.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Customer\'s unique identifier',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Dwolla OpenAPI schema.',
                    ],
                ],
            ],
            'dwolla_get_funding_source' => [
                'class' => DwollaGetFundingSource::class,
                'name' => 'Get Funding Source',
                'description' => 'Returns detailed information for a specific funding source, including its type, status, and verification details. Supports bank accounts (via Open Banking), debit card funding sources, and Dwolla balance (verified customers only). Debit card funding sources include masked card details such as brand, last four digits, expiration date, and cardholder name.

Official Dwolla endpoint: GET /funding-sources/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Funding source unique identifier',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                ],
            ],
            'dwolla_update_or_remove_funding_source' => [
                'class' => DwollaUpdateOrRemoveFundingSource::class,
                'name' => 'Update Or Remove Funding Source',
                'description' => 'Updates a bank funding source\'s details or soft deletes it. When updating, you can change the name (any status) or modify routing/account numbers and account type (unverified status only). When removing, the funding source is soft deleted and can still be accessed but marked as removed.

Official Dwolla endpoint: POST /funding-sources/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Funding source unique identifier',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Dwolla OpenAPI schema.',
                    ],
                ],
            ],
            'dwolla_get_micro_deposits' => [
                'class' => DwollaGetMicroDeposits::class,
                'name' => 'Get Micro Deposits',
                'description' => 'Returns the status and details of micro-deposits for a funding source to check verification eligibility. Includes deposit status (pending, processed, failed), creation timestamp, and failure details with ACH return codes if deposits failed. Use this endpoint to determine when micro-deposits are ready for verification.

Official Dwolla endpoint: GET /funding-sources/{id}/micro-deposits.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the FS that previously had micro-deposits initiated',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                ],
            ],
            'dwolla_initiate_or_verify_micro_deposits' => [
                'class' => DwollaInitiateOrVerifyMicroDeposits::class,
                'name' => 'Initiate Or Verify Micro Deposits',
                'description' => 'Handles micro-deposit bank verification process. Make a request without a request body to initiate two small deposits to the customer\'s bank account. Include deposit amounts to verify the received values and complete verification.

Official Dwolla endpoint: POST /funding-sources/{id}/micro-deposits.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the FS to initiate or verify micro-deposit',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Dwolla OpenAPI schema.',
                    ],
                ],
            ],
            'dwolla_get_funding_source_balance' => [
                'class' => DwollaGetFundingSourceBalance::class,
                'name' => 'Get Funding Source Balance',
                'description' => 'Returns the current balance for a specific funding source. For bank accounts, includes available and closing balances; for Dwolla balance, includes balance and total amounts; for settlement accounts (bankUsageType = card-network), includes available balance only. Supports bank accounts (via Open Banking), Dwolla balance (verified customers only), and settlement accounts for card network processing.

Official Dwolla endpoint: GET /funding-sources/{id}/balance.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'ID of funding source to retrieve the balance for',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                ],
            ],
            'dwolla_get_van_routing' => [
                'class' => DwollaGetVanRouting::class,
                'name' => 'Get Van Routing',
                'description' => 'Returns the unique account and routing numbers for a Virtual Account Number (VAN) funding source. These numbers can be used by external systems to initiate ACH transactions that pull funds from or push funds to the associated Dwolla balance.

Official Dwolla endpoint: GET /funding-sources/{id}/ach-routing.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'ID of VAN funding source to retrieve ACH details',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                ],
            ],
            'dwolla_create_on_demand_transfer_authorization' => [
                'class' => DwollaCreateOnDemandTransferAuthorization::class,
                'name' => 'Create On Demand Transfer Authorization',
                'description' => 'Create an on-demand transfer authorization that allows Customers to pre-authorize variable amount ACH transfers from their bank account for future payments. This authorization is used when creating Customer funding sources to enable flexible payment processing. Returns UI text elements including authorization body text and button text for display in your application\'s bank account addition flow.

Official Dwolla endpoint: POST /on-demand-authorizations.',
                'parameters' => [
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Dwolla OpenAPI schema.',
                    ],
                ],
            ],
            'dwolla_initiate_transfer' => [
                'class' => DwollaInitiateTransfer::class,
                'name' => 'Initiate Transfer',
                'description' => 'Initiate a transfer

Official Dwolla endpoint: POST /transfers.',
                'parameters' => [
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Idempotency-Key',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Dwolla OpenAPI schema.',
                    ],
                ],
            ],
            'dwolla_get_transfer' => [
                'class' => DwollaGetTransfer::class,
                'name' => 'Get Transfer',
                'description' => 'Retrieve a transfer

Official Dwolla endpoint: GET /transfers/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'ID of transfer to be retrieved',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                ],
            ],
            'dwolla_cancel_transfer' => [
                'class' => DwollaCancelTransfer::class,
                'name' => 'Cancel Transfer',
                'description' => 'Cancel a pending transfer by setting its status to cancelled. Only transfers in pending status can be cancelled before processing begins. Returns the updated transfer resource with cancelled status. Use this endpoint to stop a bank transfer from further processing.

Official Dwolla endpoint: POST /transfers/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'ID of transfer',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Dwolla OpenAPI schema.',
                    ],
                ],
            ],
            'dwolla_list_customer_transfers' => [
                'class' => DwollaListCustomerTransfers::class,
                'name' => 'List Customer Transfers',
                'description' => 'List and search transfers for a customer

Official Dwolla endpoint: GET /customers/{id}/transfers.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Customer\'s unique identifier',
                    ],
                    'search' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'A string to search on fields `firstName`, `lastName`, `email`, `businessName`',
                    ],
                    'start_amount' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Only include transactions with an amount equal to or greater than `startAmount`',
                    ],
                    'end_amount' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Only include transactions with an amount equal to or less than `endAmount`',
                    ],
                    'start_date' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Only include transactions created after this date. ISO-8601 format `YYYY-MM-DD`',
                    ],
                    'end_date' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Only include transactions created before this date. ISO-8601 format `YYYY-MM-DD`',
                    ],
                    'status' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Filter on transaction status. Possible values are `pending`, `processed`, `failed`, or `cancelled`',
                    ],
                    'correlation_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'A string value to search on if `correlationId` was specified for a transaction',
                    ],
                    'limit' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Number of search results to return. Defaults to 25',
                    ],
                    'offset' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Number of search results to skip. Use for pagination',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                ],
            ],
            'dwolla_list_transfer_fees' => [
                'class' => DwollaListTransferFees::class,
                'name' => 'List Transfer Fees',
                'description' => 'Retrieve detailed fee information for a specific transfer by its unique identifier. Returns the total number of fees and individual fee transaction details including amounts, status, and links to source and destination accounts.

Official Dwolla endpoint: GET /transfers/{id}/fees.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'ID of transfer to retrieve fees for',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                ],
            ],
            'dwolla_get_transfer_failure_reason' => [
                'class' => DwollaGetTransferFailureReason::class,
                'name' => 'Get Transfer Failure Reason',
                'description' => 'Retrieve a transfer failure reason

Official Dwolla endpoint: GET /transfers/{id}/failure.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Transfer unique identifier',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                ],
            ],
            'dwolla_initiate_mass_payment' => [
                'class' => DwollaInitiateMassPayment::class,
                'name' => 'Initiate Mass Payment',
                'description' => 'Create a mass payment containing up to 5,000 individual payment items from a Dwolla Main Account or Verified Customer funding source. Supports optional metadata, correlation IDs for traceability, deferred processing, and expedited transfer options including same-day ACH clearing. Returns the location of the created mass payment resource with a unique identifier for tracking and management.

Official Dwolla endpoint: POST /mass-payments.',
                'parameters' => [
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                    'idempotency_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Idempotency-Key',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Dwolla OpenAPI schema.',
                    ],
                ],
            ],
            'dwolla_get_mass_payment' => [
                'class' => DwollaGetMassPayment::class,
                'name' => 'Get Mass Payment',
                'description' => 'Retrieve detailed information for a mass payment by its unique identifier. Returns the current processing status (pending, processing, or complete), creation date, metadata, and links to the source funding source and payment items. Use this endpoint to monitor mass payment processing progress and determine when to check individual item results.

Official Dwolla endpoint: GET /mass-payments/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Mass payment unique identifier',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                ],
            ],
            'dwolla_update_mass_payment' => [
                'class' => DwollaUpdateMassPayment::class,
                'name' => 'Update Mass Payment',
                'description' => 'Update the status of a deferred mass payment to control its processing lifecycle. Set status to `pending` to trigger processing and begin fund transfers, or `cancelled` to permanently cancel the mass payment before processing begins. Only applies to mass payments created with deferred status. Returns the updated mass payment resource with the new status.

Official Dwolla endpoint: POST /mass-payments/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'ID of mass payment to update',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Dwolla OpenAPI schema.',
                    ],
                ],
            ],
            'dwolla_list_mass_payment_items' => [
                'class' => DwollaListMassPaymentItems::class,
                'name' => 'List Mass Payment Items',
                'description' => 'Retrieve individual payment items within a mass payment with optional status filtering and pagination support. Each item represents a distinct payment with status indicators (failed, pending, success) showing whether a transfer was successfully created. Returns paginated item details including amount, destination, metadata, and error information for failed items. Supports filtering by status and standard pagination.

Official Dwolla endpoint: GET /mass-payments/{id}/items.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Mass payment unique identifier',
                    ],
                    'limit' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'How many results to return',
                    ],
                    'offset' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'How many results to skip',
                    ],
                    'status' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Filter by item status',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                ],
            ],
            'dwolla_get_mass_payment_item' => [
                'class' => DwollaGetMassPaymentItem::class,
                'name' => 'Get Mass Payment Item',
                'description' => 'Retrieve detailed information for a specific mass payment item by its unique identifier. Returns item status, amount, metadata, and links to the parent mass payment, associated transfer, and destination funding source. Use this endpoint to check the processing status and details of an individual item within a mass payment batch.

Official Dwolla endpoint: GET /mass-payment-items/{itemId}.',
                'parameters' => [
                    'item_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'ID of item to be retrieved in mass payment',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                ],
            ],
            'dwolla_list_customer_mass_payments' => [
                'class' => DwollaListCustomerMassPayments::class,
                'name' => 'List Customer Mass Payments',
                'description' => 'List mass payments for customer

Official Dwolla endpoint: GET /customers/{id}/mass-payments.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Customer ID to get mass payments for',
                    ],
                    'correlation_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'A string value to search on if `correlationId` was specified for a transaction',
                    ],
                    'limit' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Number of search results to return. Defaults to 25',
                    ],
                    'offset' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Number of search results to skip. Use for pagination',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                ],
            ],
            'dwolla_get_label' => [
                'class' => DwollaGetLabel::class,
                'name' => 'Get Label',
                'description' => 'Retrieve details for a specific Label used to categorize and track funds within your account. Returns Label information including unique identifier, current amount with currency, and creation timestamp.

Official Dwolla endpoint: GET /labels/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Label unique identifier',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                ],
            ],
            'dwolla_remove_label' => [
                'class' => DwollaRemoveLabel::class,
                'name' => 'Remove Label',
                'description' => 'Delete a Label to stop tracking funds and remove it from your account. Returns success status if the Label is successfully removed. Use this to streamline your account management and remove unused Labels from your system.

Official Dwolla endpoint: DELETE /labels/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'A label unique identifier',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                ],
            ],
            'dwolla_list_customer_labels' => [
                'class' => DwollaListCustomerLabels::class,
                'name' => 'List Customer Labels',
                'description' => 'Returns all labels for a specified Verified Customer, sorted by creation date (most recent first). Supports pagination with limit and offset parameters. Each label includes its current amount and creation timestamp.

Official Dwolla endpoint: GET /customers/{id}/labels.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'ID of customer',
                    ],
                    'limit' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'How many results to return',
                    ],
                    'offset' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'How many results to skip',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                ],
            ],
            'dwolla_create_customer_label' => [
                'class' => DwollaCreateCustomerLabel::class,
                'name' => 'Create Customer Label',
                'description' => 'Creates a new label for a Verified Customer with a specified amount. Labels help organize and track funds within a customer\'s balance. Returns the location of the created label resource in the response header.

Official Dwolla endpoint: POST /customers/{id}/labels.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'ID of customer to create a label for',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Dwolla OpenAPI schema.',
                    ],
                ],
            ],
            'dwolla_list_label_ledger_entries' => [
                'class' => DwollaListLabelLedgerEntries::class,
                'name' => 'List Label Ledger Entries',
                'description' => 'Returns all ledger entries for a specific Label, sorted by creation date (newest first). Supports pagination with limit and offset parameters. Each ledger entry includes its amount, currency, and creation timestamp.

Official Dwolla endpoint: GET /labels/{id}/ledger-entries.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'A label unique identifier',
                    ],
                    'limit' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'How many results to return',
                    ],
                    'offset' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'How many results to skip',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                ],
            ],
            'dwolla_create_label_ledger_entry' => [
                'class' => DwollaCreateLabelLedgerEntry::class,
                'name' => 'Create Label Ledger Entry',
                'description' => 'Create a new ledger entry to track fund adjustments on a Label by specifying a positive or negative amount value. Returns the location of the created ledger entry in the response header. Label amounts cannot go negative, so validation errors occur if the entry would result in a negative Label balance.

Official Dwolla endpoint: POST /labels/{id}/ledger-entries.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The Id of the Label to update.',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Dwolla OpenAPI schema.',
                    ],
                ],
            ],
            'dwolla_get_label_ledger_entry' => [
                'class' => DwollaGetLabelLedgerEntry::class,
                'name' => 'Get Label Ledger Entry',
                'description' => 'Returns detailed information for a specific ledger entry on a Label, including its amount, currency, and creation timestamp.

Official Dwolla endpoint: GET /ledger-entries/{ledgerEntryId}.',
                'parameters' => [
                    'ledger_entry_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'A label ledger entry unique identifier',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                ],
            ],
            'dwolla_create_label_reallocation' => [
                'class' => DwollaCreateLabelReallocation::class,
                'name' => 'Create Label Reallocation',
                'description' => 'Reallocates funds between two labels belonging to the same Verified Customer. Moves the specified amount from the source label to the destination label, creating ledger entries for both. The reallocation only succeeds if the source label has sufficient funds.

Official Dwolla endpoint: POST /label-reallocations.',
                'parameters' => [
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Dwolla OpenAPI schema.',
                    ],
                ],
            ],
            'dwolla_retrieve_label_reallocation' => [
                'class' => DwollaRetrieveLabelReallocation::class,
                'name' => 'Retrieve Label Reallocation',
                'description' => 'Retrieve details for a specific label reallocation that transfers funds between Labels. Returns reallocation information including source and destination Labels, amount transferred, status, and creation timestamp. Use this to track and audit fund movements between different Labels.

Official Dwolla endpoint: GET /label-reallocations/{reallocationId}.',
                'parameters' => [
                    'reallocation_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Label reallocation unique identifier',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                ],
            ],
            'dwolla_list_events' => [
                'class' => DwollaListEvents::class,
                'name' => 'List Events',
                'description' => 'Returns a paginated list of events representing state changes to resources in your Dwolla application. Events track actions on customers, transfers, funding sources, and other resources, sorted by creation date (newest first). Events are retained for 30 days and are essential for webhook notifications and system activity monitoring.

Official Dwolla endpoint: GET /events.',
                'parameters' => [
                    'limit' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'How many results to return',
                    ],
                    'offset' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'How many results to skip',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                ],
            ],
            'dwolla_get_event' => [
                'class' => DwollaGetEvent::class,
                'name' => 'Get Event',
                'description' => 'Returns detailed information for a specific event representing a state change that occurred on a resource in your Dwolla application. Includes the event topic, timestamp, resource links, and correlation ID if applicable.

Official Dwolla endpoint: GET /events/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'ID of application event to get',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                ],
            ],
            'dwolla_list_webhook_subscriptions' => [
                'class' => DwollaListWebhookSubscriptions::class,
                'name' => 'List Webhook Subscriptions',
                'description' => 'Retrieve all webhook subscriptions that belong to an application including their configuration details and status. Returns subscription details including webhook endpoints, status, creation dates, and links to associated webhooks with total count. Essential for webhook management and monitoring subscription health.

Official Dwolla endpoint: GET /webhook-subscriptions.',
                'parameters' => [
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                ],
            ],
            'dwolla_create_webhook_subscription' => [
                'class' => DwollaCreateWebhookSubscription::class,
                'name' => 'Create Webhook Subscription',
                'description' => 'Create a webhook subscription to deliver webhook notifications to a specified URL endpoint for your application. Requires a destination URL where Dwolla will send notifications and a secret key for webhook validation and security. Returns the location of the created subscription resource. Essential for establishing real-time event notifications and automated integrations with Dwolla\'s payment processing events.

Official Dwolla endpoint: POST /webhook-subscriptions.',
                'parameters' => [
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Dwolla OpenAPI schema.',
                    ],
                ],
            ],
            'dwolla_get_webhook_subscription' => [
                'class' => DwollaGetWebhookSubscription::class,
                'name' => 'Get Webhook Subscription',
                'description' => 'Retrieve detailed information for a specific webhook subscription by its unique identifier. Returns subscription configuration including URL endpoint, creation date, and links to associated webhooks for comprehensive subscription management. Essential for monitoring webhook subscription status and accessing webhook delivery history.

Official Dwolla endpoint: GET /webhook-subscriptions/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Webhook subscription unique identifier',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                ],
            ],
            'dwolla_update_webhook_subscription' => [
                'class' => DwollaUpdateWebhookSubscription::class,
                'name' => 'Update Webhook Subscription',
                'description' => 'Update a webhook subscription to pause or resume webhook delivery notifications. Allows toggling the paused status to temporarily stop webhook notifications without deleting the subscription. Returns the updated subscription resource with the new paused status. Use this endpoint to manage webhook delivery during maintenance or troubleshooting periods.

Official Dwolla endpoint: POST /webhook-subscriptions/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Webhook unique identifier',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Dwolla OpenAPI schema.',
                    ],
                ],
            ],
            'dwolla_delete' => [
                'class' => DwollaDelete::class,
                'name' => 'Delete',
                'description' => 'Delete a webhook subscription to permanently remove webhook notifications for your application. This action stops all future webhook deliveries and cannot be undone. Returns the deleted subscription resource for confirmation. Use this endpoint when webhook notifications are no longer needed or when cleaning up unused subscriptions.

Official Dwolla endpoint: DELETE /webhook-subscriptions/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Webhook unique identifier',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                ],
            ],
            'dwolla_list_webhooks' => [
                'class' => DwollaListWebhooks::class,
                'name' => 'List Webhooks',
                'description' => 'List webhooks for a webhook subscription

Official Dwolla endpoint: GET /webhook-subscriptions/{id}/webhooks.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Webhook subscription unique identifier',
                    ],
                    'limit' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'How many results to return',
                    ],
                    'offset' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'How many results to skip',
                    ],
                    'start_date' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Only include webhooks created after this date. ISO-8601 format `YYYY-MM-DD`',
                    ],
                    'end_date' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Only include webhooks created before this date. ISO-8601 format `YYYY-MM-DD`',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                ],
            ],
            'dwolla_get_webhook' => [
                'class' => DwollaGetWebhook::class,
                'name' => 'Get Webhook',
                'description' => 'Retrieve detailed information for a specific webhook by its unique identifier including delivery attempts and response data. Returns webhook details with topic, account information, delivery attempts containing request/response history, and links to subscription and retry resources. Essential for debugging webhook delivery issues, analyzing response data, and monitoring notification processing status.

Official Dwolla endpoint: GET /webhooks/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Webhook unique identifier',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                ],
            ],
            'dwolla_list_webhook_retries' => [
                'class' => DwollaListWebhookRetries::class,
                'name' => 'List Webhook Retries',
                'description' => 'Retrieve all retry attempts for a specific webhook including timestamps and delivery details. Returns a list of retry attempts with unique identifiers, timestamps, and links to the parent webhook with total count. Essential for tracking webhook delivery failures, analyzing retry patterns, and debugging webhook notification issues to ensure reliable event processing.

Official Dwolla endpoint: GET /webhooks/{id}/retries.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Webhook unique identifier',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                ],
            ],
            'dwolla_retry_webhook' => [
                'class' => DwollaRetryWebhook::class,
                'name' => 'Retry Webhook',
                'description' => 'Retry a webhook by its unique identifier to redeliver the notification to your endpoint. Creates a new retry attempt and returns the location of the new webhook resource. Essential for recovering from webhook delivery failures and ensuring reliable event notification processing in your application.

Official Dwolla endpoint: POST /webhooks/{id}/retries.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Webhook unique identifier',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Dwolla OpenAPI schema.',
                    ],
                ],
            ],
            'dwolla_simulate_bank_transfer_processing' => [
                'class' => DwollaSimulateBankTransferProcessing::class,
                'name' => 'Simulate Bank Transfer Processing',
                'description' => 'Sandbox simulations (bank transfers, VAN transfers, or customer verification directives)

Official Dwolla endpoint: POST /sandbox-simulations.',
                'parameters' => [
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Dwolla OpenAPI schema.',
                    ],
                ],
            ],
            'dwolla_list_exchange_partners' => [
                'class' => DwollaListExchangePartners::class,
                'name' => 'List Exchange Partners',
                'description' => 'Returns a list of all supported exchange partners. Each partner includes a unique ID, name, and status indicating whether they are active or inactive.

Official Dwolla endpoint: GET /exchange-partners.',
                'parameters' => [
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                ],
            ],
            'dwolla_get_exchange_partner' => [
                'class' => DwollaGetExchangePartner::class,
                'name' => 'Get Exchange Partner',
                'description' => 'Returns details for a specific open banking provider that integrates with Dwolla. Includes partner name, status, and creation date. Use this to verify partner availability before creating exchanges and funding sources.

Official Dwolla endpoint: GET /exchange-partners/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Exchange Partner resource unique identifier.',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                ],
            ],
            'dwolla_list_account_exchanges' => [
                'class' => DwollaListAccountExchanges::class,
                'name' => 'List Account Exchanges',
                'description' => 'Returns all exchanges for your Dwolla account. Exchanges represent connections between external bank accounts and your account through open banking partners. Includes exchange status, creation date, and associated partner information.

Official Dwolla endpoint: GET /exchanges.',
                'parameters' => [
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                ],
            ],
            'dwolla_create_account_exchange' => [
                'class' => DwollaCreateAccountExchange::class,
                'name' => 'Create Account Exchange',
                'description' => 'Create an exchange for an account. The request body will vary based on the exchange partner. For Finicity, the request body will include finicity-specific fields. For MX Secure Exchange, the request body will include a token. For Flinks Secure Exchange, the request body will include a token. For Plaid Secure Exchange, the request body will include a token.

Official Dwolla endpoint: POST /exchanges.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Dwolla OpenAPI schema.',
                    ],
                ],
            ],
            'dwolla_get_exchange' => [
                'class' => DwollaGetExchange::class,
                'name' => 'Get Exchange',
                'description' => 'Returns details for a specific exchange connection between Dwolla and an open banking partner for a customer\'s bank account. Includes exchange status, creation date, and links to the associated customer and exchange partner.

Official Dwolla endpoint: GET /exchanges/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Exchange resource unique identifier.',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                ],
            ],
            'dwolla_list_customer_exchanges' => [
                'class' => DwollaListCustomerExchanges::class,
                'name' => 'List Customer Exchanges',
                'description' => 'Returns all exchanges for a specific customer. Exchanges represent connections between the customer\'s external bank accounts and open banking partners. Includes exchange status, creation date, and links to associated funding sources and partners.

Official Dwolla endpoint: GET /customers/{id}/exchanges.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the Customer to list exchanges for',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                ],
            ],
            'dwolla_create_customer_exchange' => [
                'class' => DwollaCreateCustomerExchange::class,
                'name' => 'Create Customer Exchange',
                'description' => 'Creates an exchange connection between a customer and Dwolla. Request body varies by partner (Plaid, MX, Flinks, Finicity, Checkout.com). For bank accounts, use Plaid, MX, Flinks, or Finicity to establish secure access to the customer\'s bank account data. For debit cards (Push to Card), use Checkout.com and pass the payment ID from Checkout.com Flow.

Official Dwolla endpoint: POST /customers/{id}/exchanges.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the customer to create an exchange for',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Dwolla OpenAPI schema.',
                    ],
                ],
            ],
            'dwolla_create_customer_exchange_session' => [
                'class' => DwollaCreateCustomerExchangeSession::class,
                'name' => 'Create Customer Exchange Session',
                'description' => 'Creates an exchange session for a customer. Use cases include: - **Plaid / MX**: Instant bank account verification (open banking). For faster verification as compared to traditional micro-deposits. - **Checkout.com**: Debit card capture for Push to Card. Create a session, then retrieve it to get `externalProviderSessionData` (payment session) for the Checkout.com Flow component.

Official Dwolla endpoint: POST /customers/{id}/exchange-sessions.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Customer\'s unique identifier',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Dwolla OpenAPI schema.',
                    ],
                ],
            ],
            'dwolla_retrieve_customer_exchange_session' => [
                'class' => DwollaRetrieveCustomerExchangeSession::class,
                'name' => 'Retrieve Customer Exchange Session',
                'description' => 'Retrieve exchange session

Official Dwolla endpoint: GET /exchange-sessions/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Exchange session\'s unique identifier',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                ],
            ],
            'dwolla_create_re_auth_exchange_session' => [
                'class' => DwollaCreateReAuthExchangeSession::class,
                'name' => 'Create Re Auth Exchange Session',
                'description' => 'Creates a re-authentication exchange session to refresh a user\'s bank account connection when their existing authorization is no longer valid. Required when receiving an UpdateCredentials error during bank balance checks or when user re-authentication is needed.

Official Dwolla endpoint: POST /exchanges/{id}/exchange-sessions.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Exchange\'s unique identifier',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official Dwolla OpenAPI schema.',
                    ],
                ],
            ],
            'dwolla_list_available_exchange_connections' => [
                'class' => DwollaListAvailableExchangeConnections::class,
                'name' => 'List Available Exchange Connections',
                'description' => 'Returns available exchange connections for a customer\'s bank accounts authorized through MX Connect. Each connection includes an account name and availableConnectionToken required to create exchanges and funding sources for transfers.

Official Dwolla endpoint: GET /customers/{id}/available-exchange-connections.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Customer\'s unique identifier',
                    ],
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                ],
            ],
            'dwolla_create_client_token' => [
                'class' => DwollaCreateClientToken::class,
                'name' => 'Create Client Token',
                'description' => 'Create a client token

Official Dwolla endpoint: POST /client-tokens.',
                'parameters' => [
                    'accept' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
                        'enum' => ['application/vnd.dwolla.v1.hal+json'],
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Dwolla OpenAPI schema.',
                    ],
                ],
            ],
        ]; }

    /** @param  array<string, mixed>  $context  Runtime account context. */
    public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); }

    /** @param  array<string, mixed>  $context  Runtime account context. */
    private function resolveService(array $context = []): DwollaService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);
            return new DwollaService(accessToken: $creds->get('dwolla', 'access_token', '', $account), clientId: $creds->get('dwolla', 'client_id', '', $account), clientSecret: $creds->get('dwolla', 'client_secret', '', $account), baseUrl: $creds->get('dwolla', 'url', 'https://api-sandbox.dwolla.com', $account));
        }

        return app(DwollaService::class);
    }

    public function luaDocsPath(): ?string { return __DIR__ . '/../lua-docs/dwolla.md'; }
    public function isIntegration(): bool { return true; }
}
