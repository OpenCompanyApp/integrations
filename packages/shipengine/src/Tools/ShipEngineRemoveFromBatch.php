<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Remove From Batch.
 *
 * Maps to the official ShipEngine endpoint POST /v1/batches/{batch_id}/remove.
 */
class ShipEngineRemoveFromBatch extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_remove_from_batch";
    protected const DESCRIPTION = "Remove From Batch\n\nOfficial ShipEngine endpoint: POST /v1/batches/{batch_id}/remove.";
    protected const PARAMETERS = [
        "batch_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Batch ID",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "JSON request body matching the official ShipEngine schema for Remove From Batch.",
        ],
    ];
    protected const METHOD = "POST";
    protected const PATH = "/v1/batches/{batch_id}/remove";
    protected const PATH_PARAMS = [
        "batch_id" => "batch_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
}
