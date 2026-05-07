<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * List Warehouses.
 *
 * Maps to the official ShipEngine endpoint GET /v1/warehouses.
 */
class ShipEngineListWarehouses extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_list_warehouses";
    protected const DESCRIPTION = "List Warehouses\n\nOfficial ShipEngine endpoint: GET /v1/warehouses.";
    protected const PARAMETERS = [];
    protected const METHOD = "GET";
    protected const PATH = "/v1/warehouses";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
}
