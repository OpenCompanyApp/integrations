<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * List all shipping labels.
 *
 * Maps to the official Shippo endpoint GET /transactions.
 */
class ShippoListTransactions extends AbstractShippoTool
{
    protected const NAME = "shippo_list_transactions";
    protected const DESCRIPTION = "List all shipping labels\n\nOfficial Shippo endpoint: GET /transactions.";
    protected const PARAMETERS = [
        "rate" => [
            "type" => "string",
            "required" => false,
            "description" => "Filter by rate ID",
        ],
        "object_status" => [
            "type" => "string",
            "enum" => [
                "WAITING",
                "QUEUED",
                "SUCCESS",
                "ERROR",
                "REFUNDED",
                "REFUNDPENDING",
                "REFUNDREJECTED",
            ],
            "required" => false,
            "description" => "Filter by object status",
        ],
        "tracking_status" => [
            "type" => "string",
            "enum" => [
                "UNKNOWN",
                "PRE_TRANSIT",
                "TRANSIT",
                "DELIVERED",
                "RETURNED",
                "FAILURE",
            ],
            "required" => false,
            "description" => "Filter by tracking status",
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
        "shippo_api_version" => [
            "type" => "string",
            "required" => false,
            "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
        ],
    ];
    protected const METHOD = "GET";
    protected const PATH = "/transactions";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        "rate" => "rate",
        "object_status" => "object_status",
        "tracking_status" => "tracking_status",
        "page" => "page",
        "results" => "results",
    ];
    protected const HEADER_PARAMS = [
        "SHIPPO-API-VERSION" => "shippo_api_version",
    ];
    protected const BODY_REQUIRED = false;
}
