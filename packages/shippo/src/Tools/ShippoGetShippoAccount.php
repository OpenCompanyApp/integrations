<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * Retrieve a Shippo Account.
 *
 * Maps to the official Shippo endpoint GET /shippo-accounts/{ShippoAccountId}.
 */
class ShippoGetShippoAccount extends AbstractShippoTool
{
    protected const NAME = "shippo_get_shippo_account";
    protected const DESCRIPTION = "Retrieve a Shippo Account\n\nOfficial Shippo endpoint: GET /shippo-accounts/{ShippoAccountId}.";
    protected const PARAMETERS = [
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
    ];
    protected const METHOD = "GET";
    protected const PATH = "/shippo-accounts/{ShippoAccountId}";
    protected const PATH_PARAMS = [
        "ShippoAccountId" => "shippo_account_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        "SHIPPO-API-VERSION" => "shippo_api_version",
    ];
    protected const BODY_REQUIRED = false;
}
