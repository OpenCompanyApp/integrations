<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Add to a Batch.
 *
 * Maps to the official ShipEngine endpoint POST /v1/batches/{batch_id}/add.
 */
class ShipEngineAddToBatch extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_add_to_batch";
    protected const DESCRIPTION = "Add to a Batch\n\nOfficial ShipEngine endpoint: POST /v1/batches/{batch_id}/add.";
    protected const PARAMETERS = [
        "batch_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Batch ID",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "JSON request body matching the official ShipEngine schema for Add to a Batch.",
        ],
    ];
    protected const METHOD = "POST";
    protected const PATH = "/v1/batches/{batch_id}/add";
    protected const PATH_PARAMS = [
        "batch_id" => "batch_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
}
