<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Create Shipments.
 *
 * Maps to the official ShipEngine endpoint POST /v1/shipments.
 */
class ShipEngineCreateShipments extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_create_shipments";
    protected const DESCRIPTION = "Create Shipments\n\nOfficial ShipEngine endpoint: POST /v1/shipments.";
    protected const PARAMETERS = [
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "JSON request body matching the official ShipEngine schema for Create Shipments.",
        ],
    ];
    protected const METHOD = "POST";
    protected const PATH = "/v1/shipments";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
}
