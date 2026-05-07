<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Process Batch ID Labels.
 *
 * Maps to the official ShipEngine endpoint POST /v1/batches/{batch_id}/process/labels.
 */
class ShipEngineProcessBatch extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_process_batch";
    protected const DESCRIPTION = "Process Batch ID Labels\n\nOfficial ShipEngine endpoint: POST /v1/batches/{batch_id}/process/labels.";
    protected const PARAMETERS = [
        "batch_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Batch ID",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "JSON request body matching the official ShipEngine schema for Process Batch ID Labels.",
        ],
    ];
    protected const METHOD = "POST";
    protected const PATH = "/v1/batches/{batch_id}/process/labels";
    protected const PATH_PARAMS = [
        "batch_id" => "batch_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
}
