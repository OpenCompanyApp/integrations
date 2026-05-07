<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * Remove shipments from a batch.
 *
 * Maps to the official Shippo endpoint POST /batches/{BatchId}/remove_shipments.
 */
class ShippoRemoveShipmentsFromBatch extends AbstractShippoTool
{
    protected const NAME = "shippo_remove_shipments_from_batch";
    protected const DESCRIPTION = "Remove shipments from a batch\n\nOfficial Shippo endpoint: POST /batches/{BatchId}/remove_shipments.";
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
            "description" => "Array of shipments object ids to remove from the batch",
        ],
    ];
    protected const METHOD = "POST";
    protected const PATH = "/batches/{BatchId}/remove_shipments";
    protected const PATH_PARAMS = [
        "BatchId" => "batch_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        "SHIPPO-API-VERSION" => "shippo_api_version",
    ];
    protected const BODY_REQUIRED = true;
}
