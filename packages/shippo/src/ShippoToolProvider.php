<?php

namespace OpenCompany\Integrations\Shippo;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Shippo\Tools\ShippoListAddresses;
use OpenCompany\Integrations\Shippo\Tools\ShippoCreateAddress;
use OpenCompany\Integrations\Shippo\Tools\ShippoGetAddress;
use OpenCompany\Integrations\Shippo\Tools\ShippoValidateAddress;
use OpenCompany\Integrations\Shippo\Tools\ShippoCreateBatch;
use OpenCompany\Integrations\Shippo\Tools\ShippoGetBatch;
use OpenCompany\Integrations\Shippo\Tools\ShippoAddShipmentsToBatch;
use OpenCompany\Integrations\Shippo\Tools\ShippoPurchaseBatch;
use OpenCompany\Integrations\Shippo\Tools\ShippoRemoveShipmentsFromBatch;
use OpenCompany\Integrations\Shippo\Tools\ShippoListCarrierAccounts;
use OpenCompany\Integrations\Shippo\Tools\ShippoCreateCarrierAccount;
use OpenCompany\Integrations\Shippo\Tools\ShippoGetCarrierAccount;
use OpenCompany\Integrations\Shippo\Tools\ShippoUpdateCarrierAccount;
use OpenCompany\Integrations\Shippo\Tools\ShippoInitiateOauth2Signin;
use OpenCompany\Integrations\Shippo\Tools\ShippoRegisterCarrierAccount;
use OpenCompany\Integrations\Shippo\Tools\ShippoGetCarrierRegistrationStatus;
use OpenCompany\Integrations\Shippo\Tools\ShippoListCustomsDeclarations;
use OpenCompany\Integrations\Shippo\Tools\ShippoCreateCustomsDeclaration;
use OpenCompany\Integrations\Shippo\Tools\ShippoGetCustomsDeclaration;
use OpenCompany\Integrations\Shippo\Tools\ShippoListCustomsItems;
use OpenCompany\Integrations\Shippo\Tools\ShippoCreateCustomsItem;
use OpenCompany\Integrations\Shippo\Tools\ShippoGetCustomsItem;
use OpenCompany\Integrations\Shippo\Tools\ShippoCreateLiveRate;
use OpenCompany\Integrations\Shippo\Tools\ShippoGetDefaultParcelTemplate;
use OpenCompany\Integrations\Shippo\Tools\ShippoUpdateDefaultParcelTemplate;
use OpenCompany\Integrations\Shippo\Tools\ShippoDeleteDefaultParcelTemplate;
use OpenCompany\Integrations\Shippo\Tools\ShippoListManifests;
use OpenCompany\Integrations\Shippo\Tools\ShippoCreateManifest;
use OpenCompany\Integrations\Shippo\Tools\ShippoGetManifest;
use OpenCompany\Integrations\Shippo\Tools\ShippoListOrders;
use OpenCompany\Integrations\Shippo\Tools\ShippoCreateOrder;
use OpenCompany\Integrations\Shippo\Tools\ShippoGetOrder;
use OpenCompany\Integrations\Shippo\Tools\ShippoListCarrierParcelTemplates;
use OpenCompany\Integrations\Shippo\Tools\ShippoGetCarrierParcelTemplate;
use OpenCompany\Integrations\Shippo\Tools\ShippoListParcels;
use OpenCompany\Integrations\Shippo\Tools\ShippoCreateParcel;
use OpenCompany\Integrations\Shippo\Tools\ShippoGetParcel;
use OpenCompany\Integrations\Shippo\Tools\ShippoCreatePickup;
use OpenCompany\Integrations\Shippo\Tools\ShippoGetRate;
use OpenCompany\Integrations\Shippo\Tools\ShippoCreateRefund;
use OpenCompany\Integrations\Shippo\Tools\ShippoListRefunds;
use OpenCompany\Integrations\Shippo\Tools\ShippoGetRefund;
use OpenCompany\Integrations\Shippo\Tools\ShippoListServiceGroups;
use OpenCompany\Integrations\Shippo\Tools\ShippoCreateServiceGroup;
use OpenCompany\Integrations\Shippo\Tools\ShippoUpdateServiceGroup;
use OpenCompany\Integrations\Shippo\Tools\ShippoDeleteServiceGroup;
use OpenCompany\Integrations\Shippo\Tools\ShippoListShipments;
use OpenCompany\Integrations\Shippo\Tools\ShippoCreateShipment;
use OpenCompany\Integrations\Shippo\Tools\ShippoGetShipment;
use OpenCompany\Integrations\Shippo\Tools\ShippoListShipmentRates;
use OpenCompany\Integrations\Shippo\Tools\ShippoListShipmentRatesByCurrencyCode;
use OpenCompany\Integrations\Shippo\Tools\ShippoCreateTrack;
use OpenCompany\Integrations\Shippo\Tools\ShippoGetTrack;
use OpenCompany\Integrations\Shippo\Tools\ShippoListTransactions;
use OpenCompany\Integrations\Shippo\Tools\ShippoCreateTransaction;
use OpenCompany\Integrations\Shippo\Tools\ShippoGetTransaction;
use OpenCompany\Integrations\Shippo\Tools\ShippoListUserParcelTemplates;
use OpenCompany\Integrations\Shippo\Tools\ShippoCreateUserParcelTemplate;
use OpenCompany\Integrations\Shippo\Tools\ShippoDeleteUserParcelTemplate;
use OpenCompany\Integrations\Shippo\Tools\ShippoGetUserParcelTemplate;
use OpenCompany\Integrations\Shippo\Tools\ShippoUpdateUserParcelTemplate;
use OpenCompany\Integrations\Shippo\Tools\ShippoListShippoAccounts;
use OpenCompany\Integrations\Shippo\Tools\ShippoCreateShippoAccount;
use OpenCompany\Integrations\Shippo\Tools\ShippoGetShippoAccount;
use OpenCompany\Integrations\Shippo\Tools\ShippoUpdateShippoAccount;
use OpenCompany\Integrations\Shippo\Tools\ShippoCreateWebhook;
use OpenCompany\Integrations\Shippo\Tools\ShippoListWebhooks;
use OpenCompany\Integrations\Shippo\Tools\ShippoGetWebhook;
use OpenCompany\Integrations\Shippo\Tools\ShippoUpdateWebhook;
use OpenCompany\Integrations\Shippo\Tools\ShippoDeleteWebhook;

/**
 * Tool catalog and configuration metadata for Shippo.
 *
 * Exposes the official Shippo OpenAPI operation set as endpoint-specific tools
 * and resolves account-specific API tokens for multi-account hosts.
 */
class ShippoToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /** @return array<string, mixed> */
    public function integrationCapabilities(): array
    {
        return ['auth' => ['strategy' => 'api_key', 'legacy_auth_type' => 'api_key', 'credential_mode' => 'secret', 'setup_flows' => ['manual_secret'], 'requires_browser_for_setup' => false, 'refreshable' => false, 'header' => 'Authorization', 'format' => 'ShippoToken {token}', 'token_keys' => ['api_token'], 'notes' => ['All operations in the official Shippo API spec use APIKeyHeader authentication.']], 'host_availability' => ['web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'], 'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal']], 'runtime_requirements' => [], 'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true]];
    }

    public function appName(): string { return 'shippo'; }
    public function appMeta(): array { return ['label' => 'Shippo', 'description' => 'Shipping labels, rates, tracking, customs, refunds, manifests, pickups, accounts, and webhooks', 'icon' => 'ph:truck', 'logo' => 'ph:truck']; }
    public function integrationMeta(): array { return ['name' => 'Shippo', 'description' => 'Manage Shippo shipping API resources including addresses, parcels, shipments, rates, labels, tracking, customs, refunds, carrier accounts, pickups, service groups, and webhooks.', 'icon' => 'ph:truck', 'logo' => 'ph:truck', 'category' => 'data', 'badge' => 'verified', 'docs_url' => 'https://docs.goshippo.com/api-reference/overview']; }
    public function configSchema(): array { return [['key' => 'api_token', 'type' => 'secret', 'label' => 'API Token', 'placeholder' => 'shippo_test_...', 'hint' => 'Shippo live or test API token. Sent as Authorization: ShippoToken {token}.', 'required' => true], ['key' => 'api_version', 'type' => 'text', 'label' => 'API Version', 'placeholder' => '2018-02-08', 'default' => '2018-02-08', 'required' => false], ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://api.goshippo.com', 'default' => 'https://api.goshippo.com', 'required' => false]]; }

    /** @param  array<string, mixed>  $config  Credential and endpoint settings. @return array{success: bool, message?: string, error?: string} */
    public function testConnection(array $config): array
    {
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.goshippo.com'), '/');
        $apiToken = (string) ($config['api_token'] ?? '');
        $apiVersion = (string) ($config['api_version'] ?? '2018-02-08') ?: '2018-02-08';
        if ($apiToken === '') { return ['success' => false, 'error' => 'Provide a Shippo API token.']; }

        try {
            $response = Http::withHeaders(['Accept' => 'application/json', 'Authorization' => 'ShippoToken ' . $apiToken, 'SHIPPO-API-VERSION' => $apiVersion])->timeout(10)->get($baseUrl . '/addresses', ['results' => 1]);
            if (!$response->successful()) { return ['success' => false, 'error' => 'Shippo API returned HTTP ' . $response->status() . '.']; }
            return ['success' => true, 'message' => 'Connected to Shippo at ' . $baseUrl . '.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array { return ['api_token' => 'required|string', 'api_version' => 'nullable|string', 'url' => 'nullable|url']; }
    public function credentialFields(): array { return $this->configSchema(); }
    public function tools(): array { return [
            "shippo_list_addresses" => [
                'class' => ShippoListAddresses::class,
                'name' => "List all addresses",
                'description' => "List all addresses\n\nOfficial Shippo endpoint: GET /addresses.",
                'parameters' => [
                    "page" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "The page number you want to select",
                    ],
                    "results" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "The number of results to return per page (max 100, default 5)",
                    ],
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                ],
            ],
            "shippo_create_address" => [
                'class' => ShippoCreateAddress::class,
                'name' => "Create a new address",
                'description' => "Create a new address\n\nOfficial Shippo endpoint: POST /addresses.",
                'parameters' => [
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Address details.",
                    ],
                ],
            ],
            "shippo_get_address" => [
                'class' => ShippoGetAddress::class,
                'name' => "Retrieve an address",
                'description' => "Retrieve an address\n\nOfficial Shippo endpoint: GET /addresses/{AddressId}.",
                'parameters' => [
                    "address_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Object ID of the address",
                    ],
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                ],
            ],
            "shippo_validate_address" => [
                'class' => ShippoValidateAddress::class,
                'name' => "Validate an address",
                'description' => "Validate an address\n\nOfficial Shippo endpoint: GET /addresses/{AddressId}/validate.",
                'parameters' => [
                    "address_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Object ID of the address",
                    ],
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                ],
            ],
            "shippo_create_batch" => [
                'class' => ShippoCreateBatch::class,
                'name' => "Create a batch",
                'description' => "Create a batch\n\nOfficial Shippo endpoint: POST /batches.",
                'parameters' => [
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Batch details.",
                    ],
                ],
            ],
            "shippo_get_batch" => [
                'class' => ShippoGetBatch::class,
                'name' => "Retrieve a batch",
                'description' => "Retrieve a batch\n\nOfficial Shippo endpoint: GET /batches/{BatchId}.",
                'parameters' => [
                    "batch_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Object ID of the batch",
                    ],
                    "page" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "The page number you want to select",
                    ],
                    "results" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "The number of results to return per page (max 100, default 5)",
                    ],
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                ],
            ],
            "shippo_add_shipments_to_batch" => [
                'class' => ShippoAddShipmentsToBatch::class,
                'name' => "Add shipments to a batch",
                'description' => "Add shipments to a batch\n\nOfficial Shippo endpoint: POST /batches/{BatchId}/add_shipments.",
                'parameters' => [
                    "batch_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Object ID of the batch",
                    ],
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Array of shipments to add to the batch",
                    ],
                ],
            ],
            "shippo_purchase_batch" => [
                'class' => ShippoPurchaseBatch::class,
                'name' => "Purchase a batch",
                'description' => "Purchase a batch\n\nOfficial Shippo endpoint: POST /batches/{BatchId}/purchase.",
                'parameters' => [
                    "batch_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Object ID of the batch",
                    ],
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                ],
            ],
            "shippo_remove_shipments_from_batch" => [
                'class' => ShippoRemoveShipmentsFromBatch::class,
                'name' => "Remove shipments from a batch",
                'description' => "Remove shipments from a batch\n\nOfficial Shippo endpoint: POST /batches/{BatchId}/remove_shipments.",
                'parameters' => [
                    "batch_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Object ID of the batch",
                    ],
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Array of shipments object ids to remove from the batch",
                    ],
                ],
            ],
            "shippo_list_carrier_accounts" => [
                'class' => ShippoListCarrierAccounts::class,
                'name' => "List all carrier accounts",
                'description' => "List all carrier accounts\n\nOfficial Shippo endpoint: GET /carrier_accounts.",
                'parameters' => [
                    "service_levels" => [
                        "type" => "boolean",
                        "required" => false,
                        "description" => "Appends the property `service_levels` to each returned carrier account",
                    ],
                    "carrier" => [
                        "type" => "string",
                        "enum" => [
                            "airterra",
                            "apc_postal",
                            "apg",
                            "aramex",
                            "asendia_us",
                            "australia_post",
                            "axlehire",
                            "better_trucks",
                            "borderguru",
                            "boxberry",
                            "bring",
                            "canada_post",
                            "chronopost",
                            "collect_plus",
                            "correios_br",
                            "correos_espana",
                            "colissimo",
                            "deutsche_post",
                            "dhl_benelux",
                            "dhl_ecommerce",
                            "dhl_express",
                            "dhl_germany_c2c",
                            "dhl_germany",
                            "dpd_de",
                            "dpd_uk",
                            "estafeta",
                            "fastway_australia",
                            "fedex",
                            "globegistics",
                            "gls_us",
                            "gophr",
                            "gso",
                            "hermes_germany_b2c",
                            "hermes_uk",
                            "hongkong_post",
                            "lasership",
                            "lso",
                            "mondial_relay",
                            "new_zealand_post",
                            "nippon_express",
                            "ontrac",
                            "parcelforce",
                            "passport",
                            "pcf",
                            "poste_italiane",
                            "posti",
                            "purolator",
                            "royal_mail",
                            "royal_mail_sf",
                            "rr_donnelley",
                            "russian_post",
                            "skypostal",
                            "stuart",
                            "swyft",
                            "uds",
                            "ups",
                            "usps",
                            "veho",
                        ],
                        "required" => false,
                        "description" => "Filter the response by the specified carrier",
                    ],
                    "account_id" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Filter the response by the specified carrier account Id",
                    ],
                    "page" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "The page number you want to select",
                    ],
                    "results" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "The number of results to return per page (max 100, default 5)",
                    ],
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                ],
            ],
            "shippo_create_carrier_account" => [
                'class' => ShippoCreateCarrierAccount::class,
                'name' => "Create a new carrier account",
                'description' => "Create a new carrier account\n\nOfficial Shippo endpoint: POST /carrier_accounts.",
                'parameters' => [
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Examples.",
                    ],
                ],
            ],
            "shippo_get_carrier_account" => [
                'class' => ShippoGetCarrierAccount::class,
                'name' => "Retrieve a carrier account",
                'description' => "Retrieve a carrier account\n\nOfficial Shippo endpoint: GET /carrier_accounts/{CarrierAccountId}.",
                'parameters' => [
                    "carrier_account_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Object ID of the carrier account",
                    ],
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                ],
            ],
            "shippo_update_carrier_account" => [
                'class' => ShippoUpdateCarrierAccount::class,
                'name' => "Update a carrier account",
                'description' => "Update a carrier account\n\nOfficial Shippo endpoint: PUT /carrier_accounts/{CarrierAccountId}.",
                'parameters' => [
                    "carrier_account_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Object ID of the carrier account",
                    ],
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => false,
                        "description" => "Examples.",
                    ],
                ],
            ],
            "shippo_initiate_oauth2_signin" => [
                'class' => ShippoInitiateOauth2Signin::class,
                'name' => "Connect an existing carrier account using OAuth 2.0",
                'description' => "Connect an existing carrier account using OAuth 2.0\n\nOfficial Shippo endpoint: GET /carrier_accounts/{CarrierAccountObjectId}/signin/initiate.",
                'parameters' => [
                    "carrier_account_object_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "The carrier account ID (UUID) to start a signin process.",
                    ],
                    "redirect_uri" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Callback URL. The URL that tells the authorization server where to send the user back to after they approve the request.",
                    ],
                    "state" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "A random string generated by the consuming application and included in the request to prevent CSRF attacks. The consuming application checks that the same value is returned after the user authorizes Shippo.",
                    ],
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                ],
            ],
            "shippo_register_carrier_account" => [
                'class' => ShippoRegisterCarrierAccount::class,
                'name' => "Add a Shippo carrier account",
                'description' => "Add a Shippo carrier account\n\nOfficial Shippo endpoint: POST /carrier_accounts/register/new.",
                'parameters' => [
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "The body of the request.",
                    ],
                ],
            ],
            "shippo_get_carrier_registration_status" => [
                'class' => ShippoGetCarrierRegistrationStatus::class,
                'name' => "Get Carrier Registration status",
                'description' => "Get Carrier Registration status\n\nOfficial Shippo endpoint: GET /carrier_accounts/reg-status.",
                'parameters' => [
                    "carrier" => [
                        "type" => "string",
                        "enum" => [
                            "ups",
                            "usps",
                            "canada_post",
                        ],
                        "required" => true,
                        "description" => "filter by specific carrier",
                    ],
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                ],
            ],
            "shippo_list_customs_declarations" => [
                'class' => ShippoListCustomsDeclarations::class,
                'name' => "List all customs declarations",
                'description' => "List all customs declarations\n\nOfficial Shippo endpoint: GET /customs/declarations.",
                'parameters' => [
                    "page" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "The page number you want to select",
                    ],
                    "results" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "The number of results to return per page (max 100, default 5)",
                    ],
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                ],
            ],
            "shippo_create_customs_declaration" => [
                'class' => ShippoCreateCustomsDeclaration::class,
                'name' => "Create a new customs declaration",
                'description' => "Create a new customs declaration\n\nOfficial Shippo endpoint: POST /customs/declarations.",
                'parameters' => [
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "CustomsDeclaration details.",
                    ],
                ],
            ],
            "shippo_get_customs_declaration" => [
                'class' => ShippoGetCustomsDeclaration::class,
                'name' => "Retrieve a customs declaration",
                'description' => "Retrieve a customs declaration\n\nOfficial Shippo endpoint: GET /customs/declarations/{CustomsDeclarationId}.",
                'parameters' => [
                    "customs_declaration_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Object ID of the customs declaration",
                    ],
                    "page" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "The page number you want to select",
                    ],
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                ],
            ],
            "shippo_list_customs_items" => [
                'class' => ShippoListCustomsItems::class,
                'name' => "List all customs items",
                'description' => "List all customs items\n\nOfficial Shippo endpoint: GET /customs/items.",
                'parameters' => [
                    "page" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "The page number you want to select",
                    ],
                    "results" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "The number of results to return per page (max 100)",
                    ],
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                ],
            ],
            "shippo_create_customs_item" => [
                'class' => ShippoCreateCustomsItem::class,
                'name' => "Create a new customs item",
                'description' => "Create a new customs item\n\nOfficial Shippo endpoint: POST /customs/items.",
                'parameters' => [
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "CustomsItem details.",
                    ],
                ],
            ],
            "shippo_get_customs_item" => [
                'class' => ShippoGetCustomsItem::class,
                'name' => "Retrieve a customs item",
                'description' => "Retrieve a customs item\n\nOfficial Shippo endpoint: GET /customs/items/{CustomsItemId}.",
                'parameters' => [
                    "customs_item_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Object ID of the customs item",
                    ],
                    "page" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "The page number you want to select",
                    ],
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                ],
            ],
            "shippo_create_live_rate" => [
                'class' => ShippoCreateLiveRate::class,
                'name' => "Generate a live rates request",
                'description' => "Generate a live rates request\n\nOfficial Shippo endpoint: POST /live-rates.",
                'parameters' => [
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Generate rates at checkout",
                    ],
                ],
            ],
            "shippo_get_default_parcel_template" => [
                'class' => ShippoGetDefaultParcelTemplate::class,
                'name' => "Show current default parcel template",
                'description' => "Show current default parcel template\n\nOfficial Shippo endpoint: GET /live-rates/settings/parcel-template.",
                'parameters' => [
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                ],
            ],
            "shippo_update_default_parcel_template" => [
                'class' => ShippoUpdateDefaultParcelTemplate::class,
                'name' => "Update default parcel template",
                'description' => "Update default parcel template\n\nOfficial Shippo endpoint: PUT /live-rates/settings/parcel-template.",
                'parameters' => [
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => false,
                        "description" => "JSON request body matching the official Shippo schema for Update default parcel template.",
                    ],
                ],
            ],
            "shippo_delete_default_parcel_template" => [
                'class' => ShippoDeleteDefaultParcelTemplate::class,
                'name' => "Clear current default parcel template",
                'description' => "Clear current default parcel template\n\nOfficial Shippo endpoint: DELETE /live-rates/settings/parcel-template.",
                'parameters' => [
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                ],
            ],
            "shippo_list_manifests" => [
                'class' => ShippoListManifests::class,
                'name' => "List all manifests",
                'description' => "List all manifests\n\nOfficial Shippo endpoint: GET /manifests.",
                'parameters' => [
                    "page" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "The page number you want to select",
                    ],
                    "results" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "The number of results to return per page (max 100, default 5)",
                    ],
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                ],
            ],
            "shippo_create_manifest" => [
                'class' => ShippoCreateManifest::class,
                'name' => "Create a new manifest",
                'description' => "Create a new manifest\n\nOfficial Shippo endpoint: POST /manifests.",
                'parameters' => [
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Manifest details and contact info.",
                    ],
                ],
            ],
            "shippo_get_manifest" => [
                'class' => ShippoGetManifest::class,
                'name' => "Retrieve a manifest",
                'description' => "Retrieve a manifest\n\nOfficial Shippo endpoint: GET /manifests/{ManifestId}.",
                'parameters' => [
                    "manifest_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Object ID of the manifest to update",
                    ],
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                ],
            ],
            "shippo_list_orders" => [
                'class' => ShippoListOrders::class,
                'name' => "List all orders",
                'description' => "List all orders\n\nOfficial Shippo endpoint: GET /orders.",
                'parameters' => [
                    "page" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "The page number you want to select",
                    ],
                    "results" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "The number of results to return per page (max 100)",
                    ],
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                    "order_status" => [
                        "type" => "array",
                        "items" => [
                            "type" => "string",
                        ],
                        "required" => false,
                        "description" => "Filter orders by order status",
                    ],
                    "shop_app" => [
                        "type" => "string",
                        "enum" => [
                            "Amazon",
                            "Bigcommerce",
                            "CSV_Import",
                            "eBay",
                            "ePages",
                            "Etsy",
                            "Godaddy",
                            "Magento",
                            "Shippo",
                            "Shopify",
                            "Spreecommerce",
                            "StripeRelay",
                            "Walmart",
                            "Weebly",
                            "WooCommerce",
                        ],
                        "required" => false,
                        "description" => "Filter orders by shop app",
                    ],
                    "start_date" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Filter orders created after the input date and time (ISO 8601 UTC format). This is based on the `placed_at` field, meaning when the order has been placed, not when the order object was created.",
                    ],
                    "end_date" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Filter orders created before the input date and time (ISO 8601 UTC format). This is based on the `placed_at` field, meaning when the order has been placed, not when the order object was created.",
                    ],
                ],
            ],
            "shippo_create_order" => [
                'class' => ShippoCreateOrder::class,
                'name' => "Create a new order",
                'description' => "Create a new order\n\nOfficial Shippo endpoint: POST /orders.",
                'parameters' => [
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Order details.",
                    ],
                ],
            ],
            "shippo_get_order" => [
                'class' => ShippoGetOrder::class,
                'name' => "Retrieve an order",
                'description' => "Retrieve an order\n\nOfficial Shippo endpoint: GET /orders/{OrderId}.",
                'parameters' => [
                    "order_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Object ID of the order",
                    ],
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                ],
            ],
            "shippo_list_carrier_parcel_templates" => [
                'class' => ShippoListCarrierParcelTemplates::class,
                'name' => "List all carrier parcel templates",
                'description' => "List all carrier parcel templates\n\nOfficial Shippo endpoint: GET /parcel-templates.",
                'parameters' => [
                    "include" => [
                        "type" => "string",
                        "enum" => [
                            "all",
                            "user",
                            "enabled",
                        ],
                        "required" => false,
                        "description" => "filter by user or enabled",
                    ],
                    "carrier" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "filter by specific carrier",
                    ],
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                ],
            ],
            "shippo_get_carrier_parcel_template" => [
                'class' => ShippoGetCarrierParcelTemplate::class,
                'name' => "Retrieve a carrier parcel templates",
                'description' => "Retrieve a carrier parcel templates\n\nOfficial Shippo endpoint: GET /parcel-templates/{CarrierParcelTemplateToken}.",
                'parameters' => [
                    "carrier_parcel_template_token" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "The unique string representation of the carrier parcel template",
                    ],
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                ],
            ],
            "shippo_list_parcels" => [
                'class' => ShippoListParcels::class,
                'name' => "List all parcels",
                'description' => "List all parcels\n\nOfficial Shippo endpoint: GET /parcels.",
                'parameters' => [
                    "page" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "The page number you want to select",
                    ],
                    "results" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "The number of results to return per page (max 100)",
                    ],
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                ],
            ],
            "shippo_create_parcel" => [
                'class' => ShippoCreateParcel::class,
                'name' => "Create a new parcel",
                'description' => "Create a new parcel\n\nOfficial Shippo endpoint: POST /parcels.",
                'parameters' => [
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Parcel details.",
                    ],
                ],
            ],
            "shippo_get_parcel" => [
                'class' => ShippoGetParcel::class,
                'name' => "Retrieve an existing parcel",
                'description' => "Retrieve an existing parcel\n\nOfficial Shippo endpoint: GET /parcels/{ParcelId}.",
                'parameters' => [
                    "parcel_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Object ID of the parcel",
                    ],
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                ],
            ],
            "shippo_create_pickup" => [
                'class' => ShippoCreatePickup::class,
                'name' => "Create a pickup",
                'description' => "Create a pickup\n\nOfficial Shippo endpoint: POST /pickups.",
                'parameters' => [
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Shippos pickups endpoint allows you to schedule pickups with USPS and DHL Express for eligible shipments that you have already created.",
                    ],
                ],
            ],
            "shippo_get_rate" => [
                'class' => ShippoGetRate::class,
                'name' => "Retrieve a rate",
                'description' => "Retrieve a rate\n\nOfficial Shippo endpoint: GET /rates/{RateId}.",
                'parameters' => [
                    "rate_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Object ID of the rate",
                    ],
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                ],
            ],
            "shippo_create_refund" => [
                'class' => ShippoCreateRefund::class,
                'name' => "Create a refund",
                'description' => "Create a refund\n\nOfficial Shippo endpoint: POST /refunds.",
                'parameters' => [
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Refund details",
                    ],
                ],
            ],
            "shippo_list_refunds" => [
                'class' => ShippoListRefunds::class,
                'name' => "List all refunds",
                'description' => "List all refunds\n\nOfficial Shippo endpoint: GET /refunds/.",
                'parameters' => [
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                ],
            ],
            "shippo_get_refund" => [
                'class' => ShippoGetRefund::class,
                'name' => "Retrieve a refund",
                'description' => "Retrieve a refund\n\nOfficial Shippo endpoint: GET /refunds/{RefundId}.",
                'parameters' => [
                    "refund_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Object ID of the refund to update",
                    ],
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                ],
            ],
            "shippo_list_service_groups" => [
                'class' => ShippoListServiceGroups::class,
                'name' => "List all service groups",
                'description' => "List all service groups\n\nOfficial Shippo endpoint: GET /service-groups.",
                'parameters' => [
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                ],
            ],
            "shippo_create_service_group" => [
                'class' => ShippoCreateServiceGroup::class,
                'name' => "Create a new service group",
                'description' => "Create a new service group\n\nOfficial Shippo endpoint: POST /service-groups.",
                'parameters' => [
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "JSON request body matching the official Shippo schema for Create a new service group.",
                    ],
                ],
            ],
            "shippo_update_service_group" => [
                'class' => ShippoUpdateServiceGroup::class,
                'name' => "Update an existing service group",
                'description' => "Update an existing service group\n\nOfficial Shippo endpoint: PUT /service-groups.",
                'parameters' => [
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => false,
                        "description" => "JSON request body matching the official Shippo schema for Update an existing service group.",
                    ],
                ],
            ],
            "shippo_delete_service_group" => [
                'class' => ShippoDeleteServiceGroup::class,
                'name' => "Delete a service group",
                'description' => "Delete a service group\n\nOfficial Shippo endpoint: DELETE /service-groups/{ServiceGroupId}.",
                'parameters' => [
                    "service_group_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Object ID of the service group",
                    ],
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                ],
            ],
            "shippo_list_shipments" => [
                'class' => ShippoListShipments::class,
                'name' => "List all shipments",
                'description' => "List all shipments\n\nOfficial Shippo endpoint: GET /shipments.",
                'parameters' => [
                    "page_token" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "The page token for paginated results",
                    ],
                    "page" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "The page number you want to select",
                    ],
                    "results" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "The number of results to return per page (max 100)",
                    ],
                    "object_created_gt" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Object(s) created greater than a provided date and time.",
                    ],
                    "object_created_gte" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Object(s) created greater than or equal to a provided date and time.",
                    ],
                    "object_created_lt" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Object(s) created lesser than a provided date and time.",
                    ],
                    "object_created_lte" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Object(s) created lesser than or equal to a provided date and time.",
                    ],
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                ],
            ],
            "shippo_create_shipment" => [
                'class' => ShippoCreateShipment::class,
                'name' => "Create a new shipment",
                'description' => "Create a new shipment\n\nOfficial Shippo endpoint: POST /shipments.",
                'parameters' => [
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Shipment details and contact info.",
                    ],
                ],
            ],
            "shippo_get_shipment" => [
                'class' => ShippoGetShipment::class,
                'name' => "Retrieve a shipment",
                'description' => "Retrieve a shipment\n\nOfficial Shippo endpoint: GET /shipments/{ShipmentId}.",
                'parameters' => [
                    "shipment_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Object ID of the shipment to update",
                    ],
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                ],
            ],
            "shippo_list_shipment_rates" => [
                'class' => ShippoListShipmentRates::class,
                'name' => "Retrieve shipment rates",
                'description' => "Retrieve shipment rates\n\nOfficial Shippo endpoint: GET /shipments/{ShipmentId}/rates.",
                'parameters' => [
                    "shipment_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Object ID of the shipment to update",
                    ],
                    "page" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "The page number you want to select",
                    ],
                    "results" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "The number of results to return per page (max 100)",
                    ],
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                ],
            ],
            "shippo_list_shipment_rates_by_currency_code" => [
                'class' => ShippoListShipmentRatesByCurrencyCode::class,
                'name' => "Retrieve shipment rates in currency",
                'description' => "Retrieve shipment rates in currency\n\nOfficial Shippo endpoint: GET /shipments/{ShipmentId}/rates/{CurrencyCode}.",
                'parameters' => [
                    "shipment_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Object ID of the shipment to update",
                    ],
                    "currency_code" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "ISO currency code for the rates",
                    ],
                    "page" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "The page number you want to select",
                    ],
                    "results" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "The number of results to return per page (max 100)",
                    ],
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                ],
            ],
            "shippo_create_track" => [
                'class' => ShippoCreateTrack::class,
                'name' => "Register a tracking webhook",
                'description' => "Register a tracking webhook\n\nOfficial Shippo endpoint: POST /tracks.",
                'parameters' => [
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "JSON request body matching the official Shippo schema for Register a tracking webhook.",
                    ],
                ],
            ],
            "shippo_get_track" => [
                'class' => ShippoGetTrack::class,
                'name' => "Get a tracking status",
                'description' => "Get a tracking status\n\nOfficial Shippo endpoint: GET /tracks/{Carrier}/{TrackingNumber}.",
                'parameters' => [
                    "tracking_number" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Tracking number",
                    ],
                    "carrier" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Name of the carrier",
                    ],
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                ],
            ],
            "shippo_list_transactions" => [
                'class' => ShippoListTransactions::class,
                'name' => "List all shipping labels",
                'description' => "List all shipping labels\n\nOfficial Shippo endpoint: GET /transactions.",
                'parameters' => [
                    "rate" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Filter by rate ID",
                    ],
                    "object_status" => [
                        "type" => "string",
                        "enum" => [
                            "WAITING",
                            "QUEUED",
                            "SUCCESS",
                            "ERROR",
                            "REFUNDED",
                            "REFUNDPENDING",
                            "REFUNDREJECTED",
                        ],
                        "required" => false,
                        "description" => "Filter by object status",
                    ],
                    "tracking_status" => [
                        "type" => "string",
                        "enum" => [
                            "UNKNOWN",
                            "PRE_TRANSIT",
                            "TRANSIT",
                            "DELIVERED",
                            "RETURNED",
                            "FAILURE",
                        ],
                        "required" => false,
                        "description" => "Filter by tracking status",
                    ],
                    "page" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "The page number you want to select",
                    ],
                    "results" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "The number of results to return per page (max 100)",
                    ],
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                ],
            ],
            "shippo_create_transaction" => [
                'class' => ShippoCreateTransaction::class,
                'name' => "Create a shipping label",
                'description' => "Create a shipping label\n\nOfficial Shippo endpoint: POST /transactions.",
                'parameters' => [
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Examples.",
                    ],
                ],
            ],
            "shippo_get_transaction" => [
                'class' => ShippoGetTransaction::class,
                'name' => "Retrieve a shipping label",
                'description' => "Retrieve a shipping label\n\nOfficial Shippo endpoint: GET /transactions/{TransactionId}.",
                'parameters' => [
                    "transaction_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Object ID of the transaction to update",
                    ],
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                ],
            ],
            "shippo_list_user_parcel_templates" => [
                'class' => ShippoListUserParcelTemplates::class,
                'name' => "List all user parcel templates",
                'description' => "List all user parcel templates\n\nOfficial Shippo endpoint: GET /user-parcel-templates.",
                'parameters' => [
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                ],
            ],
            "shippo_create_user_parcel_template" => [
                'class' => ShippoCreateUserParcelTemplate::class,
                'name' => "Create a new user parcel template",
                'description' => "Create a new user parcel template\n\nOfficial Shippo endpoint: POST /user-parcel-templates.",
                'parameters' => [
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "JSON request body matching the official Shippo schema for Create a new user parcel template.",
                    ],
                ],
            ],
            "shippo_delete_user_parcel_template" => [
                'class' => ShippoDeleteUserParcelTemplate::class,
                'name' => "Delete a user parcel template",
                'description' => "Delete a user parcel template\n\nOfficial Shippo endpoint: DELETE /user-parcel-templates/{UserParcelTemplateObjectId}.",
                'parameters' => [
                    "user_parcel_template_object_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Object ID of the user parcel template",
                    ],
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                ],
            ],
            "shippo_get_user_parcel_template" => [
                'class' => ShippoGetUserParcelTemplate::class,
                'name' => "Retrieves a user parcel template",
                'description' => "Retrieves a user parcel template\n\nOfficial Shippo endpoint: GET /user-parcel-templates/{UserParcelTemplateObjectId}.",
                'parameters' => [
                    "user_parcel_template_object_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Object ID of the user parcel template",
                    ],
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                ],
            ],
            "shippo_update_user_parcel_template" => [
                'class' => ShippoUpdateUserParcelTemplate::class,
                'name' => "Update an existing user parcel template",
                'description' => "Update an existing user parcel template\n\nOfficial Shippo endpoint: PUT /user-parcel-templates/{UserParcelTemplateObjectId}.",
                'parameters' => [
                    "user_parcel_template_object_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Object ID of the user parcel template",
                    ],
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => false,
                        "description" => "JSON request body matching the official Shippo schema for Update an existing user parcel template.",
                    ],
                ],
            ],
            "shippo_list_shippo_accounts" => [
                'class' => ShippoListShippoAccounts::class,
                'name' => "List all Shippo Accounts",
                'description' => "List all Shippo Accounts\n\nOfficial Shippo endpoint: GET /shippo-accounts.",
                'parameters' => [
                    "page" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "The page number you want to select",
                    ],
                    "results" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "The number of results to return per page (max 100)",
                    ],
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                ],
            ],
            "shippo_create_shippo_account" => [
                'class' => ShippoCreateShippoAccount::class,
                'name' => "Create a Shippo Account",
                'description' => "Create a Shippo Account\n\nOfficial Shippo endpoint: POST /shippo-accounts.",
                'parameters' => [
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "JSON request body matching the official Shippo schema for Create a Shippo Account.",
                    ],
                ],
            ],
            "shippo_get_shippo_account" => [
                'class' => ShippoGetShippoAccount::class,
                'name' => "Retrieve a Shippo Account",
                'description' => "Retrieve a Shippo Account\n\nOfficial Shippo endpoint: GET /shippo-accounts/{ShippoAccountId}.",
                'parameters' => [
                    "shippo_account_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Object ID of the ShippoAccount",
                    ],
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                ],
            ],
            "shippo_update_shippo_account" => [
                'class' => ShippoUpdateShippoAccount::class,
                'name' => "Update a Shippo Account",
                'description' => "Update a Shippo Account\n\nOfficial Shippo endpoint: PUT /shippo-accounts/{ShippoAccountId}.",
                'parameters' => [
                    "shippo_account_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Object ID of the ShippoAccount",
                    ],
                    "shippo_api_version" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => false,
                        "description" => "JSON request body matching the official Shippo schema for Update a Shippo Account.",
                    ],
                ],
            ],
            "shippo_create_webhook" => [
                'class' => ShippoCreateWebhook::class,
                'name' => "Create a new webhook",
                'description' => "Create a new webhook\n\nOfficial Shippo endpoint: POST /webhooks.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "JSON request body matching the official Shippo schema for Create a new webhook.",
                    ],
                ],
            ],
            "shippo_list_webhooks" => [
                'class' => ShippoListWebhooks::class,
                'name' => "List all webhooks",
                'description' => "List all webhooks\n\nOfficial Shippo endpoint: GET /webhooks.",
                'parameters' => [],
            ],
            "shippo_get_webhook" => [
                'class' => ShippoGetWebhook::class,
                'name' => "Retrieve a specific webhook",
                'description' => "Retrieve a specific webhook\n\nOfficial Shippo endpoint: GET /webhooks/{webhookId}.",
                'parameters' => [
                    "webhook_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Object ID of the webhook to retrieve",
                    ],
                ],
            ],
            "shippo_update_webhook" => [
                'class' => ShippoUpdateWebhook::class,
                'name' => "Update an existing webhook",
                'description' => "Update an existing webhook\n\nOfficial Shippo endpoint: PUT /webhooks/{webhookId}.",
                'parameters' => [
                    "webhook_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Object ID of the webhook to retrieve",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "JSON request body matching the official Shippo schema for Update an existing webhook.",
                    ],
                ],
            ],
            "shippo_delete_webhook" => [
                'class' => ShippoDeleteWebhook::class,
                'name' => "Delete a specific webhook",
                'description' => "Delete a specific webhook\n\nOfficial Shippo endpoint: DELETE /webhooks/{webhookId}.",
                'parameters' => [
                    "webhook_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Object ID of the webhook to delete",
                    ],
                ],
            ],
        ]; }

    /** @param  array<string, mixed>  $context  Runtime account context. */
    public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); }

    /** @param  array<string, mixed>  $context  Runtime account context. */
    private function resolveService(array $context = []): ShippoService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);
            return new ShippoService(apiToken: $creds->get('shippo', 'api_token', '', $account), baseUrl: $creds->get('shippo', 'url', 'https://api.goshippo.com', $account), apiVersion: $creds->get('shippo', 'api_version', '2018-02-08', $account));
        }

        return app(ShippoService::class);
    }

    public function luaDocsPath(): ?string { return __DIR__ . '/../lua-docs/shippo.md'; }
    public function isIntegration(): bool { return true; }
}
