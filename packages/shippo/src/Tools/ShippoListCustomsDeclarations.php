<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * List all customs declarations.
 *
 * Maps to the official Shippo endpoint GET /customs/declarations.
 */
class ShippoListCustomsDeclarations extends AbstractShippoTool
{
    protected const NAME = "shippo_list_customs_declarations";
    protected const DESCRIPTION = "List all customs declarations\n\nOfficial Shippo endpoint: GET /customs/declarations.";
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
    protected const PATH = "/customs/declarations";
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
