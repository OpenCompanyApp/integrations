<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Delete Batch By Id.
 *
 * Maps to the official ShipEngine endpoint DELETE /v1/batches/{batch_id}.
 */
class ShipEngineDeleteBatch extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_delete_batch";
    protected const DESCRIPTION = "Delete Batch By Id\n\nOfficial ShipEngine endpoint: DELETE /v1/batches/{batch_id}.";
    protected const PARAMETERS = [
        "batch_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Batch ID",
        ],
    ];
    protected const METHOD = "DELETE";
    protected const PATH = "/v1/batches/{batch_id}";
    protected const PATH_PARAMS = [
        "batch_id" => "batch_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
}
