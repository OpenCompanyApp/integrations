<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * Create a Shippo Account.
 *
 * Maps to the official Shippo endpoint POST /shippo-accounts.
 */
class ShippoCreateShippoAccount extends AbstractShippoTool
{
    protected const NAME = "shippo_create_shippo_account";
    protected const DESCRIPTION = "Create a Shippo Account\n\nOfficial Shippo endpoint: POST /shippo-accounts.";
    protected const PARAMETERS = [
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
    ];
    protected const METHOD = "POST";
    protected const PATH = "/shippo-accounts";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        "SHIPPO-API-VERSION" => "shippo_api_version",
    ];
    protected const BODY_REQUIRED = true;
}
