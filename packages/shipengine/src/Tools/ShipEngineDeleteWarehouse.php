<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Delete Warehouse By ID.
 *
 * Maps to the official ShipEngine endpoint DELETE /v1/warehouses/{warehouse_id}.
 */
class ShipEngineDeleteWarehouse extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_delete_warehouse";
    protected const DESCRIPTION = "Delete Warehouse By ID\n\nOfficial ShipEngine endpoint: DELETE /v1/warehouses/{warehouse_id}.";
    protected const PARAMETERS = [
        "warehouse_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Warehouse ID",
        ],
    ];
    protected const METHOD = "DELETE";
    protected const PATH = "/v1/warehouses/{warehouse_id}";
    protected const PATH_PARAMS = [
        "warehouse_id" => "warehouse_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
}
