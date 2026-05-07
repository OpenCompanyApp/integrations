<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Update carrier settings.
 *
 * Maps to the official ShipEngine endpoint PUT /v1/connections/carriers/{carrier_name}/{carrier_id}/settings.
 */
class ShipEngineUpdateCarrierSettings extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_update_carrier_settings";
    protected const DESCRIPTION = "Update carrier settings\n\nOfficial ShipEngine endpoint: PUT /v1/connections/carriers/{carrier_name}/{carrier_id}/settings.";
    protected const PARAMETERS = [
        "carrier_name" => [
            "type" => "string",
            "enum" => [
                "dhl_express",
                "fedex",
                "newgistics",
                "ups",
            ],
            "required" => true,
            "description" => "The carrier name, such as ups, fedex, or dhl_express.",
        ],
        "carrier_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Carrier ID",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "JSON request body matching the official ShipEngine schema for Update carrier settings.",
        ],
    ];
    protected const METHOD = "PUT";
    protected const PATH = "/v1/connections/carriers/{carrier_name}/{carrier_id}/settings";
    protected const PATH_PARAMS = [
        "carrier_name" => "carrier_name",
        "carrier_id" => "carrier_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
}
