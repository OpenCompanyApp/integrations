<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Create A Batch.
 *
 * Maps to the official ShipEngine endpoint POST /v1/batches.
 */
class ShipEngineCreateBatch extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_create_batch";
    protected const DESCRIPTION = "Create A Batch\n\nOfficial ShipEngine endpoint: POST /v1/batches.";
    protected const PARAMETERS = [
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "JSON request body matching the official ShipEngine schema for Create A Batch.",
        ],
    ];
    protected const METHOD = "POST";
    protected const PATH = "/v1/batches";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
}
