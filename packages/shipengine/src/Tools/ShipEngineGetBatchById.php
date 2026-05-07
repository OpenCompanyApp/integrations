<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Get Batch By ID.
 *
 * Maps to the official ShipEngine endpoint GET /v1/batches/{batch_id}.
 */
class ShipEngineGetBatchById extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_get_batch_by_id";
    protected const DESCRIPTION = "Get Batch By ID\n\nOfficial ShipEngine endpoint: GET /v1/batches/{batch_id}.";
    protected const PARAMETERS = [
        "batch_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Batch ID",
        ],
    ];
    protected const METHOD = "GET";
    protected const PATH = "/v1/batches/{batch_id}";
    protected const PATH_PARAMS = [
        "batch_id" => "batch_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
}
