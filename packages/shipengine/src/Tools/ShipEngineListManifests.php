<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * List Manifests.
 *
 * Maps to the official ShipEngine endpoint GET /v1/manifests.
 */
class ShipEngineListManifests extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_list_manifests";
    protected const DESCRIPTION = "List Manifests\n\nOfficial ShipEngine endpoint: GET /v1/manifests.";
    protected const PARAMETERS = [
        "warehouse_id" => [
            "type" => "string",
            "required" => false,
            "description" => "Warehouse ID",
        ],
        "ship_date_start" => [
            "type" => "string",
            "required" => false,
            "description" => "ship date start range",
        ],
        "ship_date_end" => [
            "type" => "string",
            "required" => false,
            "description" => "ship date end range",
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
        "carrier_id" => [
            "type" => "string",
            "required" => false,
            "description" => "Carrier ID",
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
        "label_ids" => [
            "type" => "array",
            "items" => [
                "type" => "string",
            ],
            "required" => false,
            "description" => "Array of label ids",
        ],
    ];
    protected const METHOD = "GET";
    protected const PATH = "/v1/manifests";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        "warehouse_id" => "warehouse_id",
        "ship_date_start" => "ship_date_start",
        "ship_date_end" => "ship_date_end",
        "created_at_start" => "created_at_start",
        "created_at_end" => "created_at_end",
        "carrier_id" => "carrier_id",
        "page" => "page",
        "page_size" => "page_size",
        "label_ids" => "label_ids",
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
}
