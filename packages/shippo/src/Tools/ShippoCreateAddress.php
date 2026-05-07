<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * Create a new address.
 *
 * Maps to the official Shippo endpoint POST /addresses.
 */
class ShippoCreateAddress extends AbstractShippoTool
{
    protected const NAME = "shippo_create_address";
    protected const DESCRIPTION = "Create a new address\n\nOfficial Shippo endpoint: POST /addresses.";
    protected const PARAMETERS = [
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
    ];
    protected const METHOD = "POST";
    protected const PATH = "/addresses";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        "SHIPPO-API-VERSION" => "shippo_api_version",
    ];
    protected const BODY_REQUIRED = true;
}
