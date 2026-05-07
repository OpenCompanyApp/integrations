<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Update Warehouse Settings.
 *
 * Maps to the official ShipEngine endpoint PUT /v1/warehouses/{warehouse_id}/settings.
 */
class ShipEngineUpdateWarehouseSettings extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_update_warehouse_settings";
    protected const DESCRIPTION = "Update Warehouse Settings\n\nOfficial ShipEngine endpoint: PUT /v1/warehouses/{warehouse_id}/settings.";
    protected const PARAMETERS = [
        "warehouse_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Warehouse ID",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "JSON request body matching the official ShipEngine schema for Update Warehouse Settings.",
        ],
    ];
    protected const METHOD = "PUT";
    protected const PATH = "/v1/warehouses/{warehouse_id}/settings";
    protected const PATH_PARAMS = [
        "warehouse_id" => "warehouse_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
}
