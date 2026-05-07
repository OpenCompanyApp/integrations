<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * Create a batch.
 *
 * Maps to the official Shippo endpoint POST /batches.
 */
class ShippoCreateBatch extends AbstractShippoTool
{
    protected const NAME = "shippo_create_batch";
    protected const DESCRIPTION = "Create a batch\n\nOfficial Shippo endpoint: POST /batches.";
    protected const PARAMETERS = [
        "shippo_api_version" => [
            "type" => "string",
            "required" => false,
            "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Batch details.",
        ],
    ];
    protected const METHOD = "POST";
    protected const PATH = "/batches";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        "SHIPPO-API-VERSION" => "shippo_api_version",
    ];
    protected const BODY_REQUIRED = true;
}
