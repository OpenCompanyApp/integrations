<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * List Batches.
 *
 * Maps to the official ShipEngine endpoint GET /v1/batches.
 */
class ShipEngineListBatches extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_list_batches";
    protected const DESCRIPTION = "List Batches\n\nOfficial ShipEngine endpoint: GET /v1/batches.";
    protected const PARAMETERS = [
        "status" => [
            "type" => "string",
            "enum" => [
                "open",
                "queued",
                "processing",
                "completed",
                "completed_with_errors",
                "archived",
                "notifying",
                "invalid",
            ],
            "required" => false,
            "description" => "The possible batch status values",
        ],
        "page" => [
            "type" => "integer",
            "required" => false,
            "description" => "Return a specific page of results. Defaults to the first page. If set to a number that's greater than the number of pages of results, an empty page is returned.",
        ],
        "page_size" => [
            "type" => "integer",
            "required" => false,
            "description" => "The number of results to return per response.",
        ],
        "sort_dir" => [
            "type" => "string",
            "enum" => [
                "asc",
                "desc",
            ],
            "required" => false,
            "description" => "Controls the sort order of the query.",
        ],
        "batch_number" => [
            "type" => "string",
            "required" => false,
            "description" => "Batch Number",
        ],
        "created_at_start" => [
            "type" => "string",
            "required" => false,
            "description" => "Only return batches that were created on or after a specific date/time",
        ],
        "created_at_end" => [
            "type" => "string",
            "required" => false,
            "description" => "Only return batches that were created on or before a specific date/time",
        ],
        "processed_at_start" => [
            "type" => "string",
            "required" => false,
            "description" => "Only return batches that were processed on or after a specific date/time",
        ],
        "processed_at_end" => [
            "type" => "string",
            "required" => false,
            "description" => "Only return batches that were processed on or before a specific date/time",
        ],
        "sort_by" => [
            "type" => "string",
            "enum" => [
                "ship_date",
                "processed_at",
                "created_at",
            ],
            "required" => false,
            "description" => "The possible batches sort by values",
        ],
    ];
    protected const METHOD = "GET";
    protected const PATH = "/v1/batches";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        "status" => "status",
        "page" => "page",
        "page_size" => "page_size",
        "sort_dir" => "sort_dir",
        "batch_number" => "batch_number",
        "created_at_start" => "created_at_start",
        "created_at_end" => "created_at_end",
        "processed_at_start" => "processed_at_start",
        "processed_at_end" => "processed_at_end",
        "sort_by" => "sort_by",
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
}
