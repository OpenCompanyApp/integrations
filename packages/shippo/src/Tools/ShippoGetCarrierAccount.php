<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * Retrieve a carrier account.
 *
 * Maps to the official Shippo endpoint GET /carrier_accounts/{CarrierAccountId}.
 */
class ShippoGetCarrierAccount extends AbstractShippoTool
{
    protected const NAME = "shippo_get_carrier_account";
    protected const DESCRIPTION = "Retrieve a carrier account\n\nOfficial Shippo endpoint: GET /carrier_accounts/{CarrierAccountId}.";
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
    ];
    protected const METHOD = "GET";
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
