<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * List Scheduled Pickups.
 *
 * Maps to the official ShipEngine endpoint GET /v1/pickups.
 */
class ShipEngineListScheduledPickups extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_list_scheduled_pickups";
    protected const DESCRIPTION = "List Scheduled Pickups\n\nOfficial ShipEngine endpoint: GET /v1/pickups.";
    protected const PARAMETERS = [
        "carrier_id" => [
            "type" => "string",
            "required" => false,
            "description" => "Carrier ID",
        ],
        "warehouse_id" => [
            "type" => "string",
            "required" => false,
            "description" => "Warehouse ID",
        ],
        "created_at_start" => [
            "type" => "string",
            "required" => false,
            "description" => "Only return scheduled pickups that were created on or after a specific date/time",
        ],
        "created_at_end" => [
            "type" => "string",
            "required" => false,
            "description" => "Only return scheduled pickups that were created on or before a specific date/time",
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
    ];
    protected const METHOD = "GET";
    protected const PATH = "/v1/pickups";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        "carrier_id" => "carrier_id",
        "warehouse_id" => "warehouse_id",
        "created_at_start" => "created_at_start",
        "created_at_end" => "created_at_end",
        "page" => "page",
        "page_size" => "page_size",
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
}
