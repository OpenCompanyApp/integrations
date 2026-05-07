<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * List all shipments.
 *
 * Maps to the official Shippo endpoint GET /shipments.
 */
class ShippoListShipments extends AbstractShippoTool
{
    protected const NAME = "shippo_list_shipments";
    protected const DESCRIPTION = "List all shipments\n\nOfficial Shippo endpoint: GET /shipments.";
    protected const PARAMETERS = [
        "page_token" => [
            "type" => "string",
            "required" => false,
            "description" => "The page token for paginated results",
        ],
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
        "object_created_gt" => [
            "type" => "string",
            "required" => false,
            "description" => "Object(s) created greater than a provided date and time.",
        ],
        "object_created_gte" => [
            "type" => "string",
            "required" => false,
            "description" => "Object(s) created greater than or equal to a provided date and time.",
        ],
        "object_created_lt" => [
            "type" => "string",
            "required" => false,
            "description" => "Object(s) created lesser than a provided date and time.",
        ],
        "object_created_lte" => [
            "type" => "string",
            "required" => false,
            "description" => "Object(s) created lesser than or equal to a provided date and time.",
        ],
        "shippo_api_version" => [
            "type" => "string",
            "required" => false,
            "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
        ],
    ];
    protected const METHOD = "GET";
    protected const PATH = "/shipments";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        "page_token" => "page_token",
        "page" => "page",
        "results" => "results",
        "object_created_gt" => "object_created_gt",
        "object_created_gte" => "object_created_gte",
        "object_created_lt" => "object_created_lt",
        "object_created_lte" => "object_created_lte",
    ];
    protected const HEADER_PARAMS = [
        "SHIPPO-API-VERSION" => "shippo_api_version",
    ];
    protected const BODY_REQUIRED = false;
}
