<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * List labels.
 *
 * Maps to the official ShipEngine endpoint GET /v1/labels.
 */
class ShipEngineListLabels extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_list_labels";
    protected const DESCRIPTION = "List labels\n\nOfficial ShipEngine endpoint: GET /v1/labels.";
    protected const PARAMETERS = [
        "label_status" => [
            "type" => "string",
            "enum" => [
                "processing",
                "completed",
                "error",
                "voided",
            ],
            "required" => false,
            "description" => "Only return labels that are currently in the specified status",
        ],
        "service_code" => [
            "type" => "string",
            "required" => false,
            "description" => "Only return labels for a specific",
        ],
        "carrier_id" => [
            "type" => "string",
            "required" => false,
            "description" => "Only return labels for a specific",
        ],
        "tracking_number" => [
            "type" => "string",
            "required" => false,
            "description" => "Only return labels with a specific tracking number",
        ],
        "batch_id" => [
            "type" => "string",
            "required" => false,
            "description" => "Only return labels that were created in a specific",
        ],
        "rate_id" => [
            "type" => "string",
            "required" => false,
            "description" => "Rate ID",
        ],
        "shipment_id" => [
            "type" => "string",
            "required" => false,
            "description" => "Shipment ID",
        ],
        "warehouse_id" => [
            "type" => "string",
            "required" => false,
            "description" => "Only return labels that originate from a specific",
        ],
        "created_at_start" => [
            "type" => "string",
            "required" => false,
            "description" => "Only return labels that were created on or after a specific date/time",
        ],
        "created_at_end" => [
            "type" => "string",
            "required" => false,
            "description" => "Only return labels that were created on or before a specific date/time",
        ],
        "refund_status" => [
            "type" => "array",
            "items" => [
                "type" => "string",
                "enum" => [
                    "request_scheduled",
                    "pending",
                    "approved",
                    "rejected",
                    "excluded",
                ],
            ],
            "required" => false,
            "description" => "Only return labels with specific refund status/es.",
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
        "sort_by" => [
            "type" => "string",
            "enum" => [
                "modified_at",
                "created_at",
                "voided_at",
            ],
            "required" => false,
            "description" => "Controls which field the query is sorted by.",
        ],
    ];
    protected const METHOD = "GET";
    protected const PATH = "/v1/labels";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        "label_status" => "label_status",
        "service_code" => "service_code",
        "carrier_id" => "carrier_id",
        "tracking_number" => "tracking_number",
        "batch_id" => "batch_id",
        "rate_id" => "rate_id",
        "shipment_id" => "shipment_id",
        "warehouse_id" => "warehouse_id",
        "created_at_start" => "created_at_start",
        "created_at_end" => "created_at_end",
        "refund_status" => "refund_status",
        "page" => "page",
        "page_size" => "page_size",
        "sort_dir" => "sort_dir",
        "sort_by" => "sort_by",
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [
        "refund_status" => "comma",
    ];
    protected const BODY_REQUIRED = false;
}
