<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * Retrieve a batch.
 *
 * Maps to the official Shippo endpoint GET /batches/{BatchId}.
 */
class ShippoGetBatch extends AbstractShippoTool
{
    protected const NAME = "shippo_get_batch";
    protected const DESCRIPTION = "Retrieve a batch\n\nOfficial Shippo endpoint: GET /batches/{BatchId}.";
    protected const PARAMETERS = [
        "batch_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Object ID of the batch",
        ],
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
    protected const PATH = "/batches/{BatchId}";
    protected const PATH_PARAMS = [
        "BatchId" => "batch_id",
    ];
    protected const QUERY_PARAMS = [
        "page" => "page",
        "results" => "results",
    ];
    protected const HEADER_PARAMS = [
        "SHIPPO-API-VERSION" => "shippo_api_version",
    ];
    protected const BODY_REQUIRED = false;
}
