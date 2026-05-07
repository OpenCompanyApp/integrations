<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Get Batch Errors.
 *
 * Maps to the official ShipEngine endpoint GET /v1/batches/{batch_id}/errors.
 */
class ShipEngineListBatchErrors extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_list_batch_errors";
    protected const DESCRIPTION = "Get Batch Errors\n\nOfficial ShipEngine endpoint: GET /v1/batches/{batch_id}/errors.";
    protected const PARAMETERS = [
        "batch_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Batch ID",
        ],
        "page" => [
            "type" => "integer",
            "required" => false,
            "description" => "Return a specific page of results. Defaults to the first page. If set to a number that's greater than the number of pages of results, an empty page is returned.",
        ],
        "pagesize" => [
            "type" => "integer",
            "required" => false,
            "description" => "query parameter `pagesize`.",
        ],
    ];
    protected const METHOD = "GET";
    protected const PATH = "/v1/batches/{batch_id}/errors";
    protected const PATH_PARAMS = [
        "batch_id" => "batch_id",
    ];
    protected const QUERY_PARAMS = [
        "page" => "page",
        "pagesize" => "pagesize",
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
}
