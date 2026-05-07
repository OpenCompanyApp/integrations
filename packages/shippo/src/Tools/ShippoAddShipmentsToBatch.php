<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * Add shipments to a batch.
 *
 * Maps to the official Shippo endpoint POST /batches/{BatchId}/add_shipments.
 */
class ShippoAddShipmentsToBatch extends AbstractShippoTool
{
    protected const NAME = "shippo_add_shipments_to_batch";
    protected const DESCRIPTION = "Add shipments to a batch\n\nOfficial Shippo endpoint: POST /batches/{BatchId}/add_shipments.";
    protected const PARAMETERS = [
        "batch_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Object ID of the batch",
        ],
        "shippo_api_version" => [
            "type" => "string",
            "required" => false,
            "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Array of shipments to add to the batch",
        ],
    ];
    protected const METHOD = "POST";
    protected const PATH = "/batches/{BatchId}/add_shipments";
    protected const PATH_PARAMS = [
        "BatchId" => "batch_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        "SHIPPO-API-VERSION" => "shippo_api_version",
    ];
    protected const BODY_REQUIRED = true;
}
