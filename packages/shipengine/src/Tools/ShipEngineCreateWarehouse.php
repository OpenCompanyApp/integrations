<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Create Warehouse.
 *
 * Maps to the official ShipEngine endpoint POST /v1/warehouses.
 */
class ShipEngineCreateWarehouse extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_create_warehouse";
    protected const DESCRIPTION = "Create Warehouse\n\nOfficial ShipEngine endpoint: POST /v1/warehouses.";
    protected const PARAMETERS = [
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "JSON request body matching the official ShipEngine schema for Create Warehouse.",
        ],
    ];
    protected const METHOD = "POST";
    protected const PATH = "/v1/warehouses";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
}
