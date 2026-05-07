<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * Purchase a batch.
 *
 * Maps to the official Shippo endpoint POST /batches/{BatchId}/purchase.
 */
class ShippoPurchaseBatch extends AbstractShippoTool
{
    protected const NAME = "shippo_purchase_batch";
    protected const DESCRIPTION = "Purchase a batch\n\nOfficial Shippo endpoint: POST /batches/{BatchId}/purchase.";
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
    ];
    protected const METHOD = "POST";
    protected const PATH = "/batches/{BatchId}/purchase";
    protected const PATH_PARAMS = [
        "BatchId" => "batch_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        "SHIPPO-API-VERSION" => "shippo_api_version",
    ];
    protected const BODY_REQUIRED = false;
}
