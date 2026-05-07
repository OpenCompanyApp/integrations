<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * Update a carrier account.
 *
 * Maps to the official Shippo endpoint PUT /carrier_accounts/{CarrierAccountId}.
 */
class ShippoUpdateCarrierAccount extends AbstractShippoTool
{
    protected const NAME = "shippo_update_carrier_account";
    protected const DESCRIPTION = "Update a carrier account\n\nOfficial Shippo endpoint: PUT /carrier_accounts/{CarrierAccountId}.";
    protected const PARAMETERS = [
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
    ];
    protected const METHOD = "PUT";
    protected const PATH = "/carrier_accounts/{CarrierAccountId}";
    protected const PATH_PARAMS = [
        "CarrierAccountId" => "carrier_account_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        "SHIPPO-API-VERSION" => "shippo_api_version",
    ];
    protected const BODY_REQUIRED = false;
}
