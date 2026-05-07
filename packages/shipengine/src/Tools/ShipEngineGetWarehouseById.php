<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Get Warehouse By Id.
 *
 * Maps to the official ShipEngine endpoint GET /v1/warehouses/{warehouse_id}.
 */
class ShipEngineGetWarehouseById extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_get_warehouse_by_id";
    protected const DESCRIPTION = "Get Warehouse By Id\n\nOfficial ShipEngine endpoint: GET /v1/warehouses/{warehouse_id}.";
    protected const PARAMETERS = [
        "warehouse_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Warehouse ID",
        ],
    ];
    protected const METHOD = "GET";
    protected const PATH = "/v1/warehouses/{warehouse_id}";
    protected const PATH_PARAMS = [
        "warehouse_id" => "warehouse_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
}
