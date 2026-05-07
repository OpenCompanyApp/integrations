<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Get Batch By External ID.
 *
 * Maps to the official ShipEngine endpoint GET /v1/batches/external_batch_id/{external_batch_id}.
 */
class ShipEngineGetBatchByExternalId extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_get_batch_by_external_id";
    protected const DESCRIPTION = "Get Batch By External ID\n\nOfficial ShipEngine endpoint: GET /v1/batches/external_batch_id/{external_batch_id}.";
    protected const PARAMETERS = [
        "external_batch_id" => [
            "type" => "string",
            "required" => true,
            "description" => "path parameter `external_batch_id`.",
        ],
    ];
    protected const METHOD = "GET";
    protected const PATH = "/v1/batches/external_batch_id/{external_batch_id}";
    protected const PATH_PARAMS = [
        "external_batch_id" => "external_batch_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
}
