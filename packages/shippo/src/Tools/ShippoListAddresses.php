<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * List all addresses.
 *
 * Maps to the official Shippo endpoint GET /addresses.
 */
class ShippoListAddresses extends AbstractShippoTool
{
    protected const NAME = "shippo_list_addresses";
    protected const DESCRIPTION = "List all addresses\n\nOfficial Shippo endpoint: GET /addresses.";
    protected const PARAMETERS = [
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
    ];
    protected const METHOD = "GET";
    protected const PATH = "/addresses";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        "page" => "page",
        "results" => "results",
    ];
    protected const HEADER_PARAMS = [
        "SHIPPO-API-VERSION" => "shippo_api_version",
    ];
    protected const BODY_REQUIRED = false;
}
