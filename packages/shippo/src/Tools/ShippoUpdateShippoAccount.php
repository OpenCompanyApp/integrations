<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * Update a Shippo Account.
 *
 * Maps to the official Shippo endpoint PUT /shippo-accounts/{ShippoAccountId}.
 */
class ShippoUpdateShippoAccount extends AbstractShippoTool
{
    protected const NAME = "shippo_update_shippo_account";
    protected const DESCRIPTION = "Update a Shippo Account\n\nOfficial Shippo endpoint: PUT /shippo-accounts/{ShippoAccountId}.";
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
        "body" => [
            "type" => "object",
            "required" => false,
            "description" => "JSON request body matching the official Shippo schema for Update a Shippo Account.",
        ],
    ];
    protected const METHOD = "PUT";
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
