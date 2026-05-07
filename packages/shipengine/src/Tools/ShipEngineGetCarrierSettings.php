<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Get carrier settings.
 *
 * Maps to the official ShipEngine endpoint GET /v1/connections/carriers/{carrier_name}/{carrier_id}/settings.
 */
class ShipEngineGetCarrierSettings extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_get_carrier_settings";
    protected const DESCRIPTION = "Get carrier settings\n\nOfficial ShipEngine endpoint: GET /v1/connections/carriers/{carrier_name}/{carrier_id}/settings.";
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
    ];
    protected const METHOD = "GET";
    protected const PATH = "/v1/connections/carriers/{carrier_name}/{carrier_id}/settings";
    protected const PATH_PARAMS = [
        "carrier_name" => "carrier_name",
        "carrier_id" => "carrier_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
}
