<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * List all parcels.
 *
 * Maps to the official Shippo endpoint GET /parcels.
 */
class ShippoListParcels extends AbstractShippoTool
{
    protected const NAME = "shippo_list_parcels";
    protected const DESCRIPTION = "List all parcels\n\nOfficial Shippo endpoint: GET /parcels.";
    protected const PARAMETERS = [
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
    ];
    protected const METHOD = "GET";
    protected const PATH = "/parcels";
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
