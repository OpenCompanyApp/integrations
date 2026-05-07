<?php

namespace OpenCompany\Integrations\ShipEngine;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineListAccountSettings;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineListAccountImages;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineCreateAccountImage;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineGetAccountSettingsImagesById;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineUpdateAccountSettingsImagesById;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineDeleteAccountImageById;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineParseAddress;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineValidateAddress;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineListBatches;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineCreateBatch;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineGetBatchByExternalId;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineDeleteBatch;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineGetBatchById;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineUpdateBatch;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineAddToBatch;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineListBatchErrors;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineProcessBatch;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineRemoveFromBatch;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineListCarriers;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineGetCarrierById;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineDisconnectCarrierById;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineAddFundsToCarrier;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineGetCarrierOptions;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineListCarrierPackageTypes;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineListCarrierServices;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineConnectCarrier;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineDisconnectCarrier;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineGetCarrierSettings;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineUpdateCarrierSettings;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineDisconnectInsurer;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineConnectInsurer;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineCreateCombinedLabelDocument;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineDownloadFile;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineListWebhooks;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineCreateWebhook;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineGetWebhookById;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineUpdateWebhook;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineDeleteWebhook;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineAddFundsToInsurance;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineGetInsuranceBalance;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineListLabels;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineCreateLabel;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineGetLabelByExternalShipmentId;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineCreateLabelFromRate;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineCreateLabelFromRateShopper;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineCreateLabelFromShipment;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineGetLabelById;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineCreateReturnLabel;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineGetTrackingLogFromLabel;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineVoidLabel;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineCancelLabelRefund;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineListManifests;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineCreateManifest;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineGetManifestById;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineGetManifestRequestById;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineListPackageTypes;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineCreatePackageType;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineGetPackageTypeById;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineUpdatePackageType;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineDeletePackageType;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineListScheduledPickups;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineSchedulePickup;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineGetPickupById;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineDeleteScheduledPickup;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineCalculateRates;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineCompareBulkRates;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineEstimateRates;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineGetRateById;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineServicePointsList;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineServicePointsGetById;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineListShipments;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineCreateShipments;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineGetShipmentByExternalId;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineParseShipment;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineGetShipmentById;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineUpdateShipment;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineCancelShipments;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineListShipmentRates;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineShipmentsUpdateTags;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineShipmentsListTags;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineTagShipment;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineUntagShipment;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineListTags;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineCreateTag;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineCreateTag2;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineDeleteTag;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineRenameTag;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineTokensGetEphemeralToken;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineGetTrackingLog;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineStartTracking;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineStopTracking;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineListWarehouses;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineCreateWarehouse;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineGetWarehouseById;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineUpdateWarehouse;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineDeleteWarehouse;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineUpdateWarehouseSettings;

/**
 * Tool catalog and configuration metadata for ShipEngine.
 *
 * Exposes the official ShipEngine OpenAPI operation set as endpoint-specific
 * tools and resolves account-specific API keys for multi-account hosts.
 */
class ShipEngineToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /** @return array<string, mixed> */
    public function integrationCapabilities(): array
    {
        return ['auth' => ['strategy' => 'api_key', 'legacy_auth_type' => 'api_key', 'credential_mode' => 'secret', 'setup_flows' => ['manual_secret'], 'requires_browser_for_setup' => false, 'refreshable' => false, 'header' => 'API-Key', 'token_keys' => ['api_key'], 'notes' => ['All operations in the official ShipEngine OpenAPI spec use API-Key header authentication.']], 'host_availability' => ['web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'], 'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal']], 'runtime_requirements' => [], 'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true]];
    }

    public function appName(): string { return 'shipengine'; }
    public function appMeta(): array { return ['label' => 'ShipEngine', 'description' => 'Shipping labels, rates, tracking, batches, carriers, warehouses, pickups, webhooks, and account settings', 'icon' => 'ph:truck', 'logo' => 'ph:truck']; }
    public function integrationMeta(): array { return ['name' => 'ShipEngine', 'description' => 'Manage ShipEngine shipping API resources including shipments, labels, rates, tracking, carriers, batches, manifests, warehouses, pickups, service points, tags, and webhooks. ShipEngine is being rebranded as ShipStation API while keeping these endpoints unchanged.', 'icon' => 'ph:truck', 'logo' => 'ph:truck', 'category' => 'data', 'badge' => 'verified', 'docs_url' => 'https://www.shipengine.com/docs/']; }
    public function configSchema(): array { return [['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'ShipEngine API key', 'hint' => 'Sent as the API-Key header.', 'required' => true], ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://api.shipengine.com', 'default' => 'https://api.shipengine.com', 'required' => false]]; }

    /** @param  array<string, mixed>  $config  Credential and endpoint settings. @return array{success: bool, message?: string, error?: string} */
    public function testConnection(array $config): array
    {
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.shipengine.com'), '/');
        $apiKey = (string) ($config['api_key'] ?? '');
        if ($apiKey === '') { return ['success' => false, 'error' => 'Provide a ShipEngine API key.']; }

        try {
            $response = Http::withHeaders(['Accept' => 'application/json', 'API-Key' => $apiKey])->timeout(10)->get($baseUrl . '/v1/account/settings');
            if (!$response->successful()) { return ['success' => false, 'error' => 'ShipEngine API returned HTTP ' . $response->status() . '.']; }
            return ['success' => true, 'message' => 'Connected to ShipEngine at ' . $baseUrl . '.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array { return ['api_key' => 'required|string', 'url' => 'nullable|url']; }
    public function credentialFields(): array { return $this->configSchema(); }
    public function tools(): array { return [
            "shipengine_list_account_settings" => [
                'class' => ShipEngineListAccountSettings::class,
                'name' => "List Account Settings",
                'description' => "List Account Settings\n\nOfficial ShipEngine endpoint: GET /v1/account/settings.",
                'parameters' => [],
            ],
            "shipengine_list_account_images" => [
                'class' => ShipEngineListAccountImages::class,
                'name' => "List Account Images",
                'description' => "List Account Images\n\nOfficial ShipEngine endpoint: GET /v1/account/settings/images.",
                'parameters' => [],
            ],
            "shipengine_create_account_image" => [
                'class' => ShipEngineCreateAccountImage::class,
                'name' => "Create an Account Image",
                'description' => "Create an Account Image\n\nOfficial ShipEngine endpoint: POST /v1/account/settings/images.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "JSON request body matching the official ShipEngine schema for Create an Account Image.",
                    ],
                ],
            ],
            "shipengine_get_account_settings_images_by_id" => [
                'class' => ShipEngineGetAccountSettingsImagesById::class,
                'name' => "Get Account Image By ID",
                'description' => "Get Account Image By ID\n\nOfficial ShipEngine endpoint: GET /v1/account/settings/images/{label_image_id}.",
                'parameters' => [
                    "label_image_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Label Image Id",
                    ],
                ],
            ],
            "shipengine_update_account_settings_images_by_id" => [
                'class' => ShipEngineUpdateAccountSettingsImagesById::class,
                'name' => "Update Account Image By ID",
                'description' => "Update Account Image By ID\n\nOfficial ShipEngine endpoint: PUT /v1/account/settings/images/{label_image_id}.",
                'parameters' => [
                    "label_image_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Label Image Id",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "JSON request body matching the official ShipEngine schema for Update Account Image By ID.",
                    ],
                ],
            ],
            "shipengine_delete_account_image_by_id" => [
                'class' => ShipEngineDeleteAccountImageById::class,
                'name' => "Delete Account Image By Id",
                'description' => "Delete Account Image By Id\n\nOfficial ShipEngine endpoint: DELETE /v1/account/settings/images/{label_image_id}.",
                'parameters' => [
                    "label_image_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Label Image Id",
                    ],
                ],
            ],
            "shipengine_parse_address" => [
                'class' => ShipEngineParseAddress::class,
                'name' => "Parse an address",
                'description' => "Parse an address\n\nOfficial ShipEngine endpoint: PUT /v1/addresses/recognize.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "The only required field is text, which is the text to be parsed. You can optionally also provide an address containing already-known values. For example, you may already know the recipient's name, city, and country, and only want to parse the street address into separate lines.",
                    ],
                ],
            ],
            "shipengine_validate_address" => [
                'class' => ShipEngineValidateAddress::class,
                'name' => "Validate An Address",
                'description' => "Validate An Address\n\nOfficial ShipEngine endpoint: POST /v1/addresses/validate.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "JSON request body matching the official ShipEngine schema for Validate An Address.",
                    ],
                ],
            ],
            "shipengine_list_batches" => [
                'class' => ShipEngineListBatches::class,
                'name' => "List Batches",
                'description' => "List Batches\n\nOfficial ShipEngine endpoint: GET /v1/batches.",
                'parameters' => [
                    "status" => [
                        "type" => "string",
                        "enum" => [
                            "open",
                            "queued",
                            "processing",
                            "completed",
                            "completed_with_errors",
                            "archived",
                            "notifying",
                            "invalid",
                        ],
                        "required" => false,
                        "description" => "The possible batch status values",
                    ],
                    "page" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "Return a specific page of results. Defaults to the first page. If set to a number that's greater than the number of pages of results, an empty page is returned.",
                    ],
                    "page_size" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "The number of results to return per response.",
                    ],
                    "sort_dir" => [
                        "type" => "string",
                        "enum" => [
                            "asc",
                            "desc",
                        ],
                        "required" => false,
                        "description" => "Controls the sort order of the query.",
                    ],
                    "batch_number" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Batch Number",
                    ],
                    "created_at_start" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Only return batches that were created on or after a specific date/time",
                    ],
                    "created_at_end" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Only return batches that were created on or before a specific date/time",
                    ],
                    "processed_at_start" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Only return batches that were processed on or after a specific date/time",
                    ],
                    "processed_at_end" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Only return batches that were processed on or before a specific date/time",
                    ],
                    "sort_by" => [
                        "type" => "string",
                        "enum" => [
                            "ship_date",
                            "processed_at",
                            "created_at",
                        ],
                        "required" => false,
                        "description" => "The possible batches sort by values",
                    ],
                ],
            ],
            "shipengine_create_batch" => [
                'class' => ShipEngineCreateBatch::class,
                'name' => "Create A Batch",
                'description' => "Create A Batch\n\nOfficial ShipEngine endpoint: POST /v1/batches.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "JSON request body matching the official ShipEngine schema for Create A Batch.",
                    ],
                ],
            ],
            "shipengine_get_batch_by_external_id" => [
                'class' => ShipEngineGetBatchByExternalId::class,
                'name' => "Get Batch By External ID",
                'description' => "Get Batch By External ID\n\nOfficial ShipEngine endpoint: GET /v1/batches/external_batch_id/{external_batch_id}.",
                'parameters' => [
                    "external_batch_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "path parameter `external_batch_id`.",
                    ],
                ],
            ],
            "shipengine_delete_batch" => [
                'class' => ShipEngineDeleteBatch::class,
                'name' => "Delete Batch By Id",
                'description' => "Delete Batch By Id\n\nOfficial ShipEngine endpoint: DELETE /v1/batches/{batch_id}.",
                'parameters' => [
                    "batch_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Batch ID",
                    ],
                ],
            ],
            "shipengine_get_batch_by_id" => [
                'class' => ShipEngineGetBatchById::class,
                'name' => "Get Batch By ID",
                'description' => "Get Batch By ID\n\nOfficial ShipEngine endpoint: GET /v1/batches/{batch_id}.",
                'parameters' => [
                    "batch_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Batch ID",
                    ],
                ],
            ],
            "shipengine_update_batch" => [
                'class' => ShipEngineUpdateBatch::class,
                'name' => "Update Batch By Id",
                'description' => "Update Batch By Id\n\nOfficial ShipEngine endpoint: PUT /v1/batches/{batch_id}.",
                'parameters' => [
                    "batch_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Batch ID",
                    ],
                ],
            ],
            "shipengine_add_to_batch" => [
                'class' => ShipEngineAddToBatch::class,
                'name' => "Add to a Batch",
                'description' => "Add to a Batch\n\nOfficial ShipEngine endpoint: POST /v1/batches/{batch_id}/add.",
                'parameters' => [
                    "batch_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Batch ID",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "JSON request body matching the official ShipEngine schema for Add to a Batch.",
                    ],
                ],
            ],
            "shipengine_list_batch_errors" => [
                'class' => ShipEngineListBatchErrors::class,
                'name' => "Get Batch Errors",
                'description' => "Get Batch Errors\n\nOfficial ShipEngine endpoint: GET /v1/batches/{batch_id}/errors.",
                'parameters' => [
                    "batch_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Batch ID",
                    ],
                    "page" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "Return a specific page of results. Defaults to the first page. If set to a number that's greater than the number of pages of results, an empty page is returned.",
                    ],
                    "pagesize" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "query parameter `pagesize`.",
                    ],
                ],
            ],
            "shipengine_process_batch" => [
                'class' => ShipEngineProcessBatch::class,
                'name' => "Process Batch ID Labels",
                'description' => "Process Batch ID Labels\n\nOfficial ShipEngine endpoint: POST /v1/batches/{batch_id}/process/labels.",
                'parameters' => [
                    "batch_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Batch ID",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "JSON request body matching the official ShipEngine schema for Process Batch ID Labels.",
                    ],
                ],
            ],
            "shipengine_remove_from_batch" => [
                'class' => ShipEngineRemoveFromBatch::class,
                'name' => "Remove From Batch",
                'description' => "Remove From Batch\n\nOfficial ShipEngine endpoint: POST /v1/batches/{batch_id}/remove.",
                'parameters' => [
                    "batch_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Batch ID",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "JSON request body matching the official ShipEngine schema for Remove From Batch.",
                    ],
                ],
            ],
            "shipengine_list_carriers" => [
                'class' => ShipEngineListCarriers::class,
                'name' => "List Carriers",
                'description' => "List Carriers\n\nOfficial ShipEngine endpoint: GET /v1/carriers.",
                'parameters' => [],
            ],
            "shipengine_get_carrier_by_id" => [
                'class' => ShipEngineGetCarrierById::class,
                'name' => "Get Carrier By ID",
                'description' => "Get Carrier By ID\n\nOfficial ShipEngine endpoint: GET /v1/carriers/{carrier_id}.",
                'parameters' => [
                    "carrier_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Carrier ID",
                    ],
                ],
            ],
            "shipengine_disconnect_carrier_by_id" => [
                'class' => ShipEngineDisconnectCarrierById::class,
                'name' => "Disconnect Carrier by ID",
                'description' => "Disconnect Carrier by ID\n\nOfficial ShipEngine endpoint: DELETE /v1/carriers/{carrier_id}.",
                'parameters' => [
                    "carrier_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Carrier ID",
                    ],
                ],
            ],
            "shipengine_add_funds_to_carrier" => [
                'class' => ShipEngineAddFundsToCarrier::class,
                'name' => "Add Funds To Carrier",
                'description' => "Add Funds To Carrier\n\nOfficial ShipEngine endpoint: PUT /v1/carriers/{carrier_id}/add_funds.",
                'parameters' => [
                    "carrier_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Carrier ID",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "JSON request body matching the official ShipEngine schema for Add Funds To Carrier.",
                    ],
                ],
            ],
            "shipengine_get_carrier_options" => [
                'class' => ShipEngineGetCarrierOptions::class,
                'name' => "Get Carrier Options",
                'description' => "Get Carrier Options\n\nOfficial ShipEngine endpoint: GET /v1/carriers/{carrier_id}/options.",
                'parameters' => [
                    "carrier_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Carrier ID",
                    ],
                ],
            ],
            "shipengine_list_carrier_package_types" => [
                'class' => ShipEngineListCarrierPackageTypes::class,
                'name' => "List Carrier Package Types",
                'description' => "List Carrier Package Types\n\nOfficial ShipEngine endpoint: GET /v1/carriers/{carrier_id}/packages.",
                'parameters' => [
                    "carrier_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Carrier ID",
                    ],
                ],
            ],
            "shipengine_list_carrier_services" => [
                'class' => ShipEngineListCarrierServices::class,
                'name' => "List Carrier Services",
                'description' => "List Carrier Services\n\nOfficial ShipEngine endpoint: GET /v1/carriers/{carrier_id}/services.",
                'parameters' => [
                    "carrier_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Carrier ID",
                    ],
                ],
            ],
            "shipengine_connect_carrier" => [
                'class' => ShipEngineConnectCarrier::class,
                'name' => "Connect a carrier account",
                'description' => "Connect a carrier account\n\nOfficial ShipEngine endpoint: POST /v1/connections/carriers/{carrier_name}.",
                'parameters' => [
                    "carrier_name" => [
                        "type" => "string",
                        "enum" => [
                            "access_worldwide",
                            "amazon_buy_shipping",
                            "amazon_shipping_uk",
                            "apc",
                            "asendia",
                            "australia_post",
                            "canada_post",
                            "dhl_ecommerce",
                            "dhl_express",
                            "dhl_express_au",
                            "dhl_express_ca",
                            "dhl_express_uk",
                            "dpd",
                            "endicia",
                            "fedex",
                            "fedex_uk",
                            "firstmile",
                            "imex",
                            "newgistics",
                            "ontrac",
                            "purolator_canada",
                            "royal_mail",
                            "rr_donnelley",
                            "seko",
                            "sendle",
                            "stamps_com",
                            "ups",
                            "lasership",
                        ],
                        "required" => true,
                        "description" => "The carrier name, such as stamps_com, ups, fedex, or dhl_express.",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "JSON request body matching the official ShipEngine schema for Connect a carrier account.",
                    ],
                ],
            ],
            "shipengine_disconnect_carrier" => [
                'class' => ShipEngineDisconnectCarrier::class,
                'name' => "Disconnect a carrier",
                'description' => "Disconnect a carrier\n\nOfficial ShipEngine endpoint: DELETE /v1/connections/carriers/{carrier_name}/{carrier_id}.",
                'parameters' => [
                    "carrier_name" => [
                        "type" => "string",
                        "enum" => [
                            "access_worldwide",
                            "amazon_buy_shipping",
                            "amazon_shipping_uk",
                            "apc",
                            "asendia",
                            "australia_post",
                            "canada_post",
                            "dhl_ecommerce",
                            "dhl_express",
                            "dhl_express_au",
                            "dhl_express_ca",
                            "dhl_express_uk",
                            "dpd",
                            "endicia",
                            "fedex",
                            "fedex_uk",
                            "firstmile",
                            "imex",
                            "newgistics",
                            "ontrac",
                            "purolator_canada",
                            "royal_mail",
                            "rr_donnelley",
                            "seko",
                            "sendle",
                            "stamps_com",
                            "ups",
                            "lasership",
                        ],
                        "required" => true,
                        "description" => "The carrier name, such as stamps_com, ups, fedex, or dhl_express.",
                    ],
                    "carrier_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Carrier ID",
                    ],
                ],
            ],
            "shipengine_get_carrier_settings" => [
                'class' => ShipEngineGetCarrierSettings::class,
                'name' => "Get carrier settings",
                'description' => "Get carrier settings\n\nOfficial ShipEngine endpoint: GET /v1/connections/carriers/{carrier_name}/{carrier_id}/settings.",
                'parameters' => [
                    "carrier_name" => [
                        "type" => "string",
                        "enum" => [
                            "dhl_express",
                            "fedex",
                            "newgistics",
                            "ups",
                        ],
                        "required" => true,
                        "description" => "The carrier name, such as ups, fedex, or dhl_express.",
                    ],
                    "carrier_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Carrier ID",
                    ],
                ],
            ],
            "shipengine_update_carrier_settings" => [
                'class' => ShipEngineUpdateCarrierSettings::class,
                'name' => "Update carrier settings",
                'description' => "Update carrier settings\n\nOfficial ShipEngine endpoint: PUT /v1/connections/carriers/{carrier_name}/{carrier_id}/settings.",
                'parameters' => [
                    "carrier_name" => [
                        "type" => "string",
                        "enum" => [
                            "dhl_express",
                            "fedex",
                            "newgistics",
                            "ups",
                        ],
                        "required" => true,
                        "description" => "The carrier name, such as ups, fedex, or dhl_express.",
                    ],
                    "carrier_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Carrier ID",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "JSON request body matching the official ShipEngine schema for Update carrier settings.",
                    ],
                ],
            ],
            "shipengine_disconnect_insurer" => [
                'class' => ShipEngineDisconnectInsurer::class,
                'name' => "Disconnect a Shipsurance Account",
                'description' => "Disconnect a Shipsurance Account\n\nOfficial ShipEngine endpoint: DELETE /v1/connections/insurance/shipsurance.",
                'parameters' => [],
            ],
            "shipengine_connect_insurer" => [
                'class' => ShipEngineConnectInsurer::class,
                'name' => "Connect a Shipsurance Account",
                'description' => "Connect a Shipsurance Account\n\nOfficial ShipEngine endpoint: POST /v1/connections/insurance/shipsurance.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "JSON request body matching the official ShipEngine schema for Connect a Shipsurance Account.",
                    ],
                ],
            ],
            "shipengine_create_combined_label_document" => [
                'class' => ShipEngineCreateCombinedLabelDocument::class,
                'name' => "Created Combined Label Document",
                'description' => "Created Combined Label Document\n\nOfficial ShipEngine endpoint: POST /v1/documents/combined_labels.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "JSON request body matching the official ShipEngine schema for Created Combined Label Document.",
                    ],
                ],
            ],
            "shipengine_download_file" => [
                'class' => ShipEngineDownloadFile::class,
                'name' => "Download File",
                'description' => "Download File\n\nOfficial ShipEngine endpoint: GET /v1/downloads/{dir}/{subdir}/{filename}.",
                'parameters' => [
                    "subdir" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "path parameter `subdir`.",
                    ],
                    "filename" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "path parameter `filename`.",
                    ],
                    "dir" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "path parameter `dir`.",
                    ],
                    "download" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "query parameter `download`.",
                    ],
                    "rotation" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "query parameter `rotation`.",
                    ],
                ],
            ],
            "shipengine_list_webhooks" => [
                'class' => ShipEngineListWebhooks::class,
                'name' => "List Webhooks",
                'description' => "List Webhooks\n\nOfficial ShipEngine endpoint: GET /v1/environment/webhooks.",
                'parameters' => [],
            ],
            "shipengine_create_webhook" => [
                'class' => ShipEngineCreateWebhook::class,
                'name' => "Create a Webhook",
                'description' => "Create a Webhook\n\nOfficial ShipEngine endpoint: POST /v1/environment/webhooks.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "JSON request body matching the official ShipEngine schema for Create a Webhook.",
                    ],
                ],
            ],
            "shipengine_get_webhook_by_id" => [
                'class' => ShipEngineGetWebhookById::class,
                'name' => "Get Webhook By ID",
                'description' => "Get Webhook By ID\n\nOfficial ShipEngine endpoint: GET /v1/environment/webhooks/{webhook_id}.",
                'parameters' => [
                    "webhook_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Webhook ID",
                    ],
                ],
            ],
            "shipengine_update_webhook" => [
                'class' => ShipEngineUpdateWebhook::class,
                'name' => "Update a Webhook",
                'description' => "Update a Webhook\n\nOfficial ShipEngine endpoint: PUT /v1/environment/webhooks/{webhook_id}.",
                'parameters' => [
                    "webhook_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Webhook ID",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "JSON request body matching the official ShipEngine schema for Update a Webhook.",
                    ],
                ],
            ],
            "shipengine_delete_webhook" => [
                'class' => ShipEngineDeleteWebhook::class,
                'name' => "Delete Webhook By ID",
                'description' => "Delete Webhook By ID\n\nOfficial ShipEngine endpoint: DELETE /v1/environment/webhooks/{webhook_id}.",
                'parameters' => [
                    "webhook_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Webhook ID",
                    ],
                ],
            ],
            "shipengine_add_funds_to_insurance" => [
                'class' => ShipEngineAddFundsToInsurance::class,
                'name' => "Add Funds To Insurance",
                'description' => "Add Funds To Insurance\n\nOfficial ShipEngine endpoint: PATCH /v1/insurance/shipsurance/add_funds.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "JSON request body matching the official ShipEngine schema for Add Funds To Insurance.",
                    ],
                ],
            ],
            "shipengine_get_insurance_balance" => [
                'class' => ShipEngineGetInsuranceBalance::class,
                'name' => "Get Insurance Funds Balance",
                'description' => "Get Insurance Funds Balance\n\nOfficial ShipEngine endpoint: GET /v1/insurance/shipsurance/balance.",
                'parameters' => [],
            ],
            "shipengine_list_labels" => [
                'class' => ShipEngineListLabels::class,
                'name' => "List labels",
                'description' => "List labels\n\nOfficial ShipEngine endpoint: GET /v1/labels.",
                'parameters' => [
                    "label_status" => [
                        "type" => "string",
                        "enum" => [
                            "processing",
                            "completed",
                            "error",
                            "voided",
                        ],
                        "required" => false,
                        "description" => "Only return labels that are currently in the specified status",
                    ],
                    "service_code" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Only return labels for a specific",
                    ],
                    "carrier_id" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Only return labels for a specific",
                    ],
                    "tracking_number" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Only return labels with a specific tracking number",
                    ],
                    "batch_id" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Only return labels that were created in a specific",
                    ],
                    "rate_id" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Rate ID",
                    ],
                    "shipment_id" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Shipment ID",
                    ],
                    "warehouse_id" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Only return labels that originate from a specific",
                    ],
                    "created_at_start" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Only return labels that were created on or after a specific date/time",
                    ],
                    "created_at_end" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Only return labels that were created on or before a specific date/time",
                    ],
                    "refund_status" => [
                        "type" => "array",
                        "items" => [
                            "type" => "string",
                            "enum" => [
                                "request_scheduled",
                                "pending",
                                "approved",
                                "rejected",
                                "excluded",
                            ],
                        ],
                        "required" => false,
                        "description" => "Only return labels with specific refund status/es.",
                    ],
                    "page" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "Return a specific page of results. Defaults to the first page. If set to a number that's greater than the number of pages of results, an empty page is returned.",
                    ],
                    "page_size" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "The number of results to return per response.",
                    ],
                    "sort_dir" => [
                        "type" => "string",
                        "enum" => [
                            "asc",
                            "desc",
                        ],
                        "required" => false,
                        "description" => "Controls the sort order of the query.",
                    ],
                    "sort_by" => [
                        "type" => "string",
                        "enum" => [
                            "modified_at",
                            "created_at",
                            "voided_at",
                        ],
                        "required" => false,
                        "description" => "Controls which field the query is sorted by.",
                    ],
                ],
            ],
            "shipengine_create_label" => [
                'class' => ShipEngineCreateLabel::class,
                'name' => "Purchase Label",
                'description' => "Purchase Label\n\nOfficial ShipEngine endpoint: POST /v1/labels.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "JSON request body matching the official ShipEngine schema for Purchase Label.",
                    ],
                ],
            ],
            "shipengine_get_label_by_external_shipment_id" => [
                'class' => ShipEngineGetLabelByExternalShipmentId::class,
                'name' => "Get Label By External Shipment ID",
                'description' => "Get Label By External Shipment ID\n\nOfficial ShipEngine endpoint: GET /v1/labels/external_shipment_id/{external_shipment_id}.",
                'parameters' => [
                    "external_shipment_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "path parameter `external_shipment_id`.",
                    ],
                    "label_download_type" => [
                        "type" => "string",
                        "enum" => [
                            "url",
                            "inline",
                        ],
                        "required" => false,
                        "description" => "There are two different ways to : Label Download Type Description -------------------------------------------------- url You will receive a URL, which you can use to download the label in a separate request. The URL will remain valid for 90 days. inline You will receive the Base64-encoded label as part of the response. No need for a second request to download the label.",
                    ],
                ],
            ],
            "shipengine_create_label_from_rate" => [
                'class' => ShipEngineCreateLabelFromRate::class,
                'name' => "Purchase Label with Rate ID",
                'description' => "Purchase Label with Rate ID\n\nOfficial ShipEngine endpoint: POST /v1/labels/rates/{rate_id}.",
                'parameters' => [
                    "rate_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Rate ID",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "JSON request body matching the official ShipEngine schema for Purchase Label with Rate ID.",
                    ],
                ],
            ],
            "shipengine_create_label_from_rate_shopper" => [
                'class' => ShipEngineCreateLabelFromRateShopper::class,
                'name' => "Purchase Label from Rate Shopper",
                'description' => "Purchase Label from Rate Shopper\n\nOfficial ShipEngine endpoint: POST /v1/labels/rate_shopper_id/{rate_shopper_id}.",
                'parameters' => [
                    "rate_shopper_id" => [
                        "type" => "string",
                        "enum" => [
                            "best_value",
                            "cheapest",
                            "fastest",
                        ],
                        "required" => true,
                        "description" => "The rate selection strategy for the Rate Shopper. This determines which carrier and service will be automatically selected from your wallet carriers based on the rates returned for the shipment.",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Label creation details with inline shipment",
                    ],
                ],
            ],
            "shipengine_create_label_from_shipment" => [
                'class' => ShipEngineCreateLabelFromShipment::class,
                'name' => "Purchase Label with Shipment ID",
                'description' => "Purchase Label with Shipment ID\n\nOfficial ShipEngine endpoint: POST /v1/labels/shipment/{shipment_id}.",
                'parameters' => [
                    "shipment_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Shipment ID",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "JSON request body matching the official ShipEngine schema for Purchase Label with Shipment ID.",
                    ],
                ],
            ],
            "shipengine_get_label_by_id" => [
                'class' => ShipEngineGetLabelById::class,
                'name' => "Get Label By ID",
                'description' => "Get Label By ID\n\nOfficial ShipEngine endpoint: GET /v1/labels/{label_id}.",
                'parameters' => [
                    "label_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Label ID",
                    ],
                    "label_download_type" => [
                        "type" => "string",
                        "enum" => [
                            "url",
                            "inline",
                        ],
                        "required" => false,
                        "description" => "There are two different ways to : Label Download Type Description -------------------------------------------------- url You will receive a URL, which you can use to download the label in a separate request. The URL will remain valid for 90 days. inline You will receive the Base64-encoded label as part of the response. No need for a second request to download the label.",
                    ],
                ],
            ],
            "shipengine_create_return_label" => [
                'class' => ShipEngineCreateReturnLabel::class,
                'name' => "Create a return label",
                'description' => "Create a return label\n\nOfficial ShipEngine endpoint: POST /v1/labels/{label_id}/return.",
                'parameters' => [
                    "label_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Label ID",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "JSON request body matching the official ShipEngine schema for Create a return label.",
                    ],
                ],
            ],
            "shipengine_get_tracking_log_from_label" => [
                'class' => ShipEngineGetTrackingLogFromLabel::class,
                'name' => "Get Label Tracking Information",
                'description' => "Get Label Tracking Information\n\nOfficial ShipEngine endpoint: GET /v1/labels/{label_id}/track.",
                'parameters' => [
                    "label_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Label ID",
                    ],
                ],
            ],
            "shipengine_void_label" => [
                'class' => ShipEngineVoidLabel::class,
                'name' => "Void a Label By ID",
                'description' => "Void a Label By ID\n\nOfficial ShipEngine endpoint: PUT /v1/labels/{label_id}/void.",
                'parameters' => [
                    "label_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Label ID",
                    ],
                ],
            ],
            "shipengine_cancel_label_refund" => [
                'class' => ShipEngineCancelLabelRefund::class,
                'name' => "Cancel a label refund request",
                'description' => "Cancel a label refund request\n\nOfficial ShipEngine endpoint: POST /v1/labels/{label_id}/cancel_refund.",
                'parameters' => [
                    "label_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Label ID",
                    ],
                ],
            ],
            "shipengine_list_manifests" => [
                'class' => ShipEngineListManifests::class,
                'name' => "List Manifests",
                'description' => "List Manifests\n\nOfficial ShipEngine endpoint: GET /v1/manifests.",
                'parameters' => [
                    "warehouse_id" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Warehouse ID",
                    ],
                    "ship_date_start" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "ship date start range",
                    ],
                    "ship_date_end" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "ship date end range",
                    ],
                    "created_at_start" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Used to create a filter for when a resource was created (ex. A shipment that was created after a certain time)",
                    ],
                    "created_at_end" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Used to create a filter for when a resource was created, (ex. A shipment that was created before a certain time)",
                    ],
                    "carrier_id" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Carrier ID",
                    ],
                    "page" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "Return a specific page of results. Defaults to the first page. If set to a number that's greater than the number of pages of results, an empty page is returned.",
                    ],
                    "page_size" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "The number of results to return per response.",
                    ],
                    "label_ids" => [
                        "type" => "array",
                        "items" => [
                            "type" => "string",
                        ],
                        "required" => false,
                        "description" => "Array of label ids",
                    ],
                ],
            ],
            "shipengine_create_manifest" => [
                'class' => ShipEngineCreateManifest::class,
                'name' => "Create Manifest",
                'description' => "Create Manifest\n\nOfficial ShipEngine endpoint: POST /v1/manifests.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "JSON request body matching the official ShipEngine schema for Create Manifest.",
                    ],
                ],
            ],
            "shipengine_get_manifest_by_id" => [
                'class' => ShipEngineGetManifestById::class,
                'name' => "Get Manifest By Id",
                'description' => "Get Manifest By Id\n\nOfficial ShipEngine endpoint: GET /v1/manifests/{manifest_id}.",
                'parameters' => [
                    "manifest_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "The Manifest Id",
                    ],
                ],
            ],
            "shipengine_get_manifest_request_by_id" => [
                'class' => ShipEngineGetManifestRequestById::class,
                'name' => "Get Manifest Request By Id",
                'description' => "Get Manifest Request By Id\n\nOfficial ShipEngine endpoint: GET /v1/manifests/requests/{manifest_request_id}.",
                'parameters' => [
                    "manifest_request_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "The Manifest Request Id",
                    ],
                ],
            ],
            "shipengine_list_package_types" => [
                'class' => ShipEngineListPackageTypes::class,
                'name' => "List Custom Package Types",
                'description' => "List Custom Package Types\n\nOfficial ShipEngine endpoint: GET /v1/packages.",
                'parameters' => [],
            ],
            "shipengine_create_package_type" => [
                'class' => ShipEngineCreatePackageType::class,
                'name' => "Create Custom Package Type",
                'description' => "Create Custom Package Type\n\nOfficial ShipEngine endpoint: POST /v1/packages.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "JSON request body matching the official ShipEngine schema for Create Custom Package Type.",
                    ],
                ],
            ],
            "shipengine_get_package_type_by_id" => [
                'class' => ShipEngineGetPackageTypeById::class,
                'name' => "Get Custom Package Type By ID",
                'description' => "Get Custom Package Type By ID\n\nOfficial ShipEngine endpoint: GET /v1/packages/{package_id}.",
                'parameters' => [
                    "package_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Package ID",
                    ],
                ],
            ],
            "shipengine_update_package_type" => [
                'class' => ShipEngineUpdatePackageType::class,
                'name' => "Update Custom Package Type By ID",
                'description' => "Update Custom Package Type By ID\n\nOfficial ShipEngine endpoint: PUT /v1/packages/{package_id}.",
                'parameters' => [
                    "package_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Package ID",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "JSON request body matching the official ShipEngine schema for Update Custom Package Type By ID.",
                    ],
                ],
            ],
            "shipengine_delete_package_type" => [
                'class' => ShipEngineDeletePackageType::class,
                'name' => "Delete A Custom Package By ID",
                'description' => "Delete A Custom Package By ID\n\nOfficial ShipEngine endpoint: DELETE /v1/packages/{package_id}.",
                'parameters' => [
                    "package_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Package ID",
                    ],
                ],
            ],
            "shipengine_list_scheduled_pickups" => [
                'class' => ShipEngineListScheduledPickups::class,
                'name' => "List Scheduled Pickups",
                'description' => "List Scheduled Pickups\n\nOfficial ShipEngine endpoint: GET /v1/pickups.",
                'parameters' => [
                    "carrier_id" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Carrier ID",
                    ],
                    "warehouse_id" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Warehouse ID",
                    ],
                    "created_at_start" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Only return scheduled pickups that were created on or after a specific date/time",
                    ],
                    "created_at_end" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Only return scheduled pickups that were created on or before a specific date/time",
                    ],
                    "page" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "Return a specific page of results. Defaults to the first page. If set to a number that's greater than the number of pages of results, an empty page is returned.",
                    ],
                    "page_size" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "The number of results to return per response.",
                    ],
                ],
            ],
            "shipengine_schedule_pickup" => [
                'class' => ShipEngineSchedulePickup::class,
                'name' => "Schedule a Pickup",
                'description' => "Schedule a Pickup\n\nOfficial ShipEngine endpoint: POST /v1/pickups.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "JSON request body matching the official ShipEngine schema for Schedule a Pickup.",
                    ],
                ],
            ],
            "shipengine_get_pickup_by_id" => [
                'class' => ShipEngineGetPickupById::class,
                'name' => "Get Pickup By ID",
                'description' => "Get Pickup By ID\n\nOfficial ShipEngine endpoint: GET /v1/pickups/{pickup_id}.",
                'parameters' => [
                    "pickup_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Pickup Resource ID",
                    ],
                ],
            ],
            "shipengine_delete_scheduled_pickup" => [
                'class' => ShipEngineDeleteScheduledPickup::class,
                'name' => "Delete a Scheduled Pickup",
                'description' => "Delete a Scheduled Pickup\n\nOfficial ShipEngine endpoint: DELETE /v1/pickups/{pickup_id}.",
                'parameters' => [
                    "pickup_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Pickup Resource ID",
                    ],
                ],
            ],
            "shipengine_calculate_rates" => [
                'class' => ShipEngineCalculateRates::class,
                'name' => "Get Shipping Rates",
                'description' => "Get Shipping Rates\n\nOfficial ShipEngine endpoint: POST /v1/rates.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "JSON request body matching the official ShipEngine schema for Get Shipping Rates.",
                    ],
                ],
            ],
            "shipengine_compare_bulk_rates" => [
                'class' => ShipEngineCompareBulkRates::class,
                'name' => "Get Bulk Rates",
                'description' => "Get Bulk Rates\n\nOfficial ShipEngine endpoint: POST /v1/rates/bulk.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "JSON request body matching the official ShipEngine schema for Get Bulk Rates.",
                    ],
                ],
            ],
            "shipengine_estimate_rates" => [
                'class' => ShipEngineEstimateRates::class,
                'name' => "Estimate Rates",
                'description' => "Estimate Rates\n\nOfficial ShipEngine endpoint: POST /v1/rates/estimate.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "JSON request body matching the official ShipEngine schema for Estimate Rates.",
                    ],
                ],
            ],
            "shipengine_get_rate_by_id" => [
                'class' => ShipEngineGetRateById::class,
                'name' => "Get Rate By ID",
                'description' => "Get Rate By ID\n\nOfficial ShipEngine endpoint: GET /v1/rates/{rate_id}.",
                'parameters' => [
                    "rate_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Rate ID",
                    ],
                ],
            ],
            "shipengine_service_points_list" => [
                'class' => ShipEngineServicePointsList::class,
                'name' => "List Service Points",
                'description' => "List Service Points\n\nOfficial ShipEngine endpoint: POST /v1/service_points/list.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "JSON request body matching the official ShipEngine schema for List Service Points.",
                    ],
                ],
            ],
            "shipengine_service_points_get_by_id" => [
                'class' => ShipEngineServicePointsGetById::class,
                'name' => "Get Service Point By ID",
                'description' => "Get Service Point By ID\n\nOfficial ShipEngine endpoint: GET /v1/service_points/{carrier_code}/{country_code}/{service_point_id}.",
                'parameters' => [
                    "carrier_code" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Carrier code",
                    ],
                    "country_code" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "A two-letter",
                    ],
                    "service_point_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "path parameter `service_point_id`.",
                    ],
                ],
            ],
            "shipengine_list_shipments" => [
                'class' => ShipEngineListShipments::class,
                'name' => "List Shipments",
                'description' => "List Shipments\n\nOfficial ShipEngine endpoint: GET /v1/shipments.",
                'parameters' => [
                    "shipment_status" => [
                        "type" => "string",
                        "enum" => [
                            "pending",
                            "processing",
                            "label_purchased",
                            "cancelled",
                        ],
                        "required" => false,
                        "description" => "The possible shipment status values",
                    ],
                    "batch_id" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Batch ID",
                    ],
                    "tag" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Search for shipments based on the custom tag added to the shipment object",
                    ],
                    "created_at_start" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Used to create a filter for when a resource was created (ex. A shipment that was created after a certain time)",
                    ],
                    "created_at_end" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Used to create a filter for when a resource was created, (ex. A shipment that was created before a certain time)",
                    ],
                    "modified_at_start" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Used to create a filter for when a resource was modified (ex. A shipment that was modified after a certain time)",
                    ],
                    "modified_at_end" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Used to create a filter for when a resource was modified (ex. A shipment that was modified before a certain time)",
                    ],
                    "page" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "Return a specific page of results. Defaults to the first page. If set to a number that's greater than the number of pages of results, an empty page is returned.",
                    ],
                    "page_size" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "The number of results to return per response.",
                    ],
                    "sales_order_id" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Sales Order ID",
                    ],
                    "sort_dir" => [
                        "type" => "string",
                        "enum" => [
                            "asc",
                            "desc",
                        ],
                        "required" => false,
                        "description" => "Controls the sort order of the query.",
                    ],
                    "sort_by" => [
                        "type" => "string",
                        "enum" => [
                            "modified_at",
                            "created_at",
                        ],
                        "required" => false,
                        "description" => "The possible shipments sort by values",
                    ],
                ],
            ],
            "shipengine_create_shipments" => [
                'class' => ShipEngineCreateShipments::class,
                'name' => "Create Shipments",
                'description' => "Create Shipments\n\nOfficial ShipEngine endpoint: POST /v1/shipments.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "JSON request body matching the official ShipEngine schema for Create Shipments.",
                    ],
                ],
            ],
            "shipengine_get_shipment_by_external_id" => [
                'class' => ShipEngineGetShipmentByExternalId::class,
                'name' => "Get Shipment By External ID",
                'description' => "Get Shipment By External ID\n\nOfficial ShipEngine endpoint: GET /v1/shipments/external_shipment_id/{external_shipment_id}.",
                'parameters' => [
                    "external_shipment_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "path parameter `external_shipment_id`.",
                    ],
                ],
            ],
            "shipengine_parse_shipment" => [
                'class' => ShipEngineParseShipment::class,
                'name' => "Parse shipping info",
                'description' => "Parse shipping info\n\nOfficial ShipEngine endpoint: PUT /v1/shipments/recognize.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "The only required field is text, which is the text to be parsed. You can optionally also provide a shipment containing any already-known values. For example, you probably already know the ship_from address, and you may also already know what carrier and service you want to use.",
                    ],
                ],
            ],
            "shipengine_get_shipment_by_id" => [
                'class' => ShipEngineGetShipmentById::class,
                'name' => "Get Shipment By ID",
                'description' => "Get Shipment By ID\n\nOfficial ShipEngine endpoint: GET /v1/shipments/{shipment_id}.",
                'parameters' => [
                    "shipment_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Shipment ID",
                    ],
                ],
            ],
            "shipengine_update_shipment" => [
                'class' => ShipEngineUpdateShipment::class,
                'name' => "Update Shipment By ID",
                'description' => "Update Shipment By ID\n\nOfficial ShipEngine endpoint: PUT /v1/shipments/{shipment_id}.",
                'parameters' => [
                    "shipment_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Shipment ID",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "JSON request body matching the official ShipEngine schema for Update Shipment By ID.",
                    ],
                ],
            ],
            "shipengine_cancel_shipments" => [
                'class' => ShipEngineCancelShipments::class,
                'name' => "Cancel a Shipment",
                'description' => "Cancel a Shipment\n\nOfficial ShipEngine endpoint: PUT /v1/shipments/{shipment_id}/cancel.",
                'parameters' => [
                    "shipment_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Shipment ID",
                    ],
                ],
            ],
            "shipengine_list_shipment_rates" => [
                'class' => ShipEngineListShipmentRates::class,
                'name' => "Get Shipment Rates",
                'description' => "Get Shipment Rates\n\nOfficial ShipEngine endpoint: GET /v1/shipments/{shipment_id}/rates.",
                'parameters' => [
                    "shipment_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Shipment ID",
                    ],
                    "created_at_start" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Used to create a filter for when a resource was created (ex. A shipment that was created after a certain time)",
                    ],
                ],
            ],
            "shipengine_shipments_update_tags" => [
                'class' => ShipEngineShipmentsUpdateTags::class,
                'name' => "Update Shipments Tags",
                'description' => "Update Shipments Tags\n\nOfficial ShipEngine endpoint: PUT /v1/shipments/tags.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "JSON request body matching the official ShipEngine schema for Update Shipments Tags.",
                    ],
                ],
            ],
            "shipengine_shipments_list_tags" => [
                'class' => ShipEngineShipmentsListTags::class,
                'name' => "Get Shipment Tags",
                'description' => "Get Shipment Tags\n\nOfficial ShipEngine endpoint: GET /v1/shipments/{shipment_id}/tags.",
                'parameters' => [
                    "shipment_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Shipment ID",
                    ],
                ],
            ],
            "shipengine_tag_shipment" => [
                'class' => ShipEngineTagShipment::class,
                'name' => "Add Tag to Shipment",
                'description' => "Add Tag to Shipment\n\nOfficial ShipEngine endpoint: POST /v1/shipments/{shipment_id}/tags/{tag_name}.",
                'parameters' => [
                    "shipment_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Shipment ID",
                    ],
                    "tag_name" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Tags are arbitrary strings that you can use to categorize shipments. For example, you may want to use tags to distinguish between domestic and international shipments, or between insured and uninsured shipments. Or maybe you want to create a tag for each of your customers so you can easily retrieve every shipment for a customer.",
                    ],
                ],
            ],
            "shipengine_untag_shipment" => [
                'class' => ShipEngineUntagShipment::class,
                'name' => "Remove Tag from Shipment",
                'description' => "Remove Tag from Shipment\n\nOfficial ShipEngine endpoint: DELETE /v1/shipments/{shipment_id}/tags/{tag_name}.",
                'parameters' => [
                    "shipment_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Shipment ID",
                    ],
                    "tag_name" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Tags are arbitrary strings that you can use to categorize shipments. For example, you may want to use tags to distinguish between domestic and international shipments, or between insured and uninsured shipments. Or maybe you want to create a tag for each of your customers so you can easily retrieve every shipment for a customer.",
                    ],
                ],
            ],
            "shipengine_list_tags" => [
                'class' => ShipEngineListTags::class,
                'name' => "Get Tags",
                'description' => "Get Tags\n\nOfficial ShipEngine endpoint: GET /v1/tags.",
                'parameters' => [],
            ],
            "shipengine_create_tag" => [
                'class' => ShipEngineCreateTag::class,
                'name' => "Create a New Tag",
                'description' => "Create a New Tag\n\nOfficial ShipEngine endpoint: POST /v1/tags.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "JSON request body matching the official ShipEngine schema for Create a New Tag.",
                    ],
                ],
            ],
            "shipengine_create_tag_2" => [
                'class' => ShipEngineCreateTag2::class,
                'name' => "Create a New Tag",
                'description' => "Create a New Tag\n\nOfficial ShipEngine endpoint: POST /v1/tags/{tag_name}.",
                'parameters' => [
                    "tag_name" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Tags are arbitrary strings that you can use to categorize shipments. For example, you may want to use tags to distinguish between domestic and international shipments, or between insured and uninsured shipments. Or maybe you want to create a tag for each of your customers so you can easily retrieve every shipment for a customer.",
                    ],
                ],
            ],
            "shipengine_delete_tag" => [
                'class' => ShipEngineDeleteTag::class,
                'name' => "Delete Tag",
                'description' => "Delete Tag\n\nOfficial ShipEngine endpoint: DELETE /v1/tags/{tag_name}.",
                'parameters' => [
                    "tag_name" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Tags are arbitrary strings that you can use to categorize shipments. For example, you may want to use tags to distinguish between domestic and international shipments, or between insured and uninsured shipments. Or maybe you want to create a tag for each of your customers so you can easily retrieve every shipment for a customer.",
                    ],
                ],
            ],
            "shipengine_rename_tag" => [
                'class' => ShipEngineRenameTag::class,
                'name' => "Update Tag Name",
                'description' => "Update Tag Name\n\nOfficial ShipEngine endpoint: PUT /v1/tags/{tag_name}/{new_tag_name}.",
                'parameters' => [
                    "tag_name" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Tags are arbitrary strings that you can use to categorize shipments. For example, you may want to use tags to distinguish between domestic and international shipments, or between insured and uninsured shipments. Or maybe you want to create a tag for each of your customers so you can easily retrieve every shipment for a customer.",
                    ],
                    "new_tag_name" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Tags are arbitrary strings that you can use to categorize shipments. For example, you may want to use tags to distinguish between domestic and international shipments, or between insured and uninsured shipments. Or maybe you want to create a tag for each of your customers so you can easily retrieve every shipment for a customer.",
                    ],
                ],
            ],
            "shipengine_tokens_get_ephemeral_token" => [
                'class' => ShipEngineTokensGetEphemeralToken::class,
                'name' => "Get Ephemeral Token",
                'description' => "Get Ephemeral Token\n\nOfficial ShipEngine endpoint: POST /v1/tokens/ephemeral.",
                'parameters' => [
                    "redirect" => [
                        "type" => "string",
                        "enum" => [
                            "shipengine-dashboard",
                        ],
                        "required" => false,
                        "description" => "Include a redirect url to the application formatted with the ephemeral token.",
                    ],
                ],
            ],
            "shipengine_get_tracking_log" => [
                'class' => ShipEngineGetTrackingLog::class,
                'name' => "Get Tracking Information",
                'description' => "Get Tracking Information\n\nOfficial ShipEngine endpoint: GET /v1/tracking.",
                'parameters' => [
                    "carrier_code" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "A , such as fedex, dhl_express, stamps_com, etc.",
                    ],
                    "tracking_number" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "The tracking number associated with a shipment",
                    ],
                    "carrier_id" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Carrier ID",
                    ],
                ],
            ],
            "shipengine_start_tracking" => [
                'class' => ShipEngineStartTracking::class,
                'name' => "Start Tracking a Package",
                'description' => "Start Tracking a Package\n\nOfficial ShipEngine endpoint: POST /v1/tracking/start.",
                'parameters' => [
                    "carrier_code" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "A , such as fedex, dhl_express, stamps_com, etc.",
                    ],
                    "tracking_number" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "The tracking number associated with a shipment",
                    ],
                    "carrier_id" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Carrier ID",
                    ],
                ],
            ],
            "shipengine_stop_tracking" => [
                'class' => ShipEngineStopTracking::class,
                'name' => "Stop Tracking a Package",
                'description' => "Stop Tracking a Package\n\nOfficial ShipEngine endpoint: POST /v1/tracking/stop.",
                'parameters' => [
                    "carrier_code" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "A , such as fedex, dhl_express, stamps_com, etc.",
                    ],
                    "tracking_number" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "The tracking number associated with a shipment",
                    ],
                    "carrier_id" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Carrier ID",
                    ],
                ],
            ],
            "shipengine_list_warehouses" => [
                'class' => ShipEngineListWarehouses::class,
                'name' => "List Warehouses",
                'description' => "List Warehouses\n\nOfficial ShipEngine endpoint: GET /v1/warehouses.",
                'parameters' => [],
            ],
            "shipengine_create_warehouse" => [
                'class' => ShipEngineCreateWarehouse::class,
                'name' => "Create Warehouse",
                'description' => "Create Warehouse\n\nOfficial ShipEngine endpoint: POST /v1/warehouses.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "JSON request body matching the official ShipEngine schema for Create Warehouse.",
                    ],
                ],
            ],
            "shipengine_get_warehouse_by_id" => [
                'class' => ShipEngineGetWarehouseById::class,
                'name' => "Get Warehouse By Id",
                'description' => "Get Warehouse By Id\n\nOfficial ShipEngine endpoint: GET /v1/warehouses/{warehouse_id}.",
                'parameters' => [
                    "warehouse_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Warehouse ID",
                    ],
                ],
            ],
            "shipengine_update_warehouse" => [
                'class' => ShipEngineUpdateWarehouse::class,
                'name' => "Update Warehouse By Id",
                'description' => "Update Warehouse By Id\n\nOfficial ShipEngine endpoint: PUT /v1/warehouses/{warehouse_id}.",
                'parameters' => [
                    "warehouse_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Warehouse ID",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "JSON request body matching the official ShipEngine schema for Update Warehouse By Id.",
                    ],
                ],
            ],
            "shipengine_delete_warehouse" => [
                'class' => ShipEngineDeleteWarehouse::class,
                'name' => "Delete Warehouse By ID",
                'description' => "Delete Warehouse By ID\n\nOfficial ShipEngine endpoint: DELETE /v1/warehouses/{warehouse_id}.",
                'parameters' => [
                    "warehouse_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Warehouse ID",
                    ],
                ],
            ],
            "shipengine_update_warehouse_settings" => [
                'class' => ShipEngineUpdateWarehouseSettings::class,
                'name' => "Update Warehouse Settings",
                'description' => "Update Warehouse Settings\n\nOfficial ShipEngine endpoint: PUT /v1/warehouses/{warehouse_id}/settings.",
                'parameters' => [
                    "warehouse_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Warehouse ID",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "JSON request body matching the official ShipEngine schema for Update Warehouse Settings.",
                    ],
                ],
            ],
        ]; }

    /** @param  array<string, mixed>  $context  Runtime account context. */
    public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); }

    /** @param  array<string, mixed>  $context  Runtime account context. */
    private function resolveService(array $context = []): ShipEngineService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);
            return new ShipEngineService(apiKey: $creds->get('shipengine', 'api_key', '', $account), baseUrl: $creds->get('shipengine', 'url', 'https://api.shipengine.com', $account));
        }

        return app(ShipEngineService::class);
    }

    public function luaDocsPath(): ?string { return __DIR__ . '/../lua-docs/shipengine.md'; }
    public function isIntegration(): bool { return true; }
}
