<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Update Batch By Id.
 *
 * Maps to the official ShipEngine endpoint PUT /v1/batches/{batch_id}.
 */
class ShipEngineUpdateBatch extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_update_batch";
    protected const DESCRIPTION = "Update Batch By Id\n\nOfficial ShipEngine endpoint: PUT /v1/batches/{batch_id}.";
    protected const PARAMETERS = [
        "batch_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Batch ID",
        ],
    ];
    protected const METHOD = "PUT";
    protected const PATH = "/v1/batches/{batch_id}";
    protected const PATH_PARAMS = [
        "batch_id" => "batch_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
}
