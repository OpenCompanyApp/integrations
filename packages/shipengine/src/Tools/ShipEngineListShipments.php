<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * List Shipments.
 *
 * Maps to the official ShipEngine endpoint GET /v1/shipments.
 */
class ShipEngineListShipments extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_list_shipments";
    protected const DESCRIPTION = "List Shipments\n\nOfficial ShipEngine endpoint: GET /v1/shipments.";
    protected const PARAMETERS = [
        "shipment_status" => [
            "type" => "string",
            "enum" => [
                "pending",
                "processing",
                "label_purchased",
                "cancelled",
            ],
            "required" => false,
            "description" => "The possible shipment status values",
        ],
        "batch_id" => [
            "type" => "string",
            "required" => false,
            "description" => "Batch ID",
        ],
        "tag" => [
            "type" => "string",
            "required" => false,
            "description" => "Search for shipments based on the custom tag added to the shipment object",
        ],
        "created_at_start" => [
            "type" => "string",
            "required" => false,
            "description" => "Used to create a filter for when a resource was created (ex. A shipment that was created after a certain time)",
        ],
        "created_at_end" => [
            "type" => "string",
            "required" => false,
            "description" => "Used to create a filter for when a resource was created, (ex. A shipment that was created before a certain time)",
        ],
        "modified_at_start" => [
            "type" => "string",
            "required" => false,
            "description" => "Used to create a filter for when a resource was modified (ex. A shipment that was modified after a certain time)",
        ],
        "modified_at_end" => [
            "type" => "string",
            "required" => false,
            "description" => "Used to create a filter for when a resource was modified (ex. A shipment that was modified before a certain time)",
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
        "sales_order_id" => [
            "type" => "string",
            "required" => false,
            "description" => "Sales Order ID",
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
        "sort_by" => [
            "type" => "string",
            "enum" => [
                "modified_at",
                "created_at",
            ],
            "required" => false,
            "description" => "The possible shipments sort by values",
        ],
    ];
    protected const METHOD = "GET";
    protected const PATH = "/v1/shipments";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        "shipment_status" => "shipment_status",
        "batch_id" => "batch_id",
        "tag" => "tag",
        "created_at_start" => "created_at_start",
        "created_at_end" => "created_at_end",
        "modified_at_start" => "modified_at_start",
        "modified_at_end" => "modified_at_end",
        "page" => "page",
        "page_size" => "page_size",
        "sales_order_id" => "sales_order_id",
        "sort_dir" => "sort_dir",
        "sort_by" => "sort_by",
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
}
