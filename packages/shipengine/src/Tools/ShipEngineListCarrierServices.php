<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * List Carrier Services.
 *
 * Maps to the official ShipEngine endpoint GET /v1/carriers/{carrier_id}/services.
 */
class ShipEngineListCarrierServices extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_list_carrier_services";
    protected const DESCRIPTION = "List Carrier Services\n\nOfficial ShipEngine endpoint: GET /v1/carriers/{carrier_id}/services.";
    protected const PARAMETERS = [
        "carrier_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Carrier ID",
        ],
    ];
    protected const METHOD = "GET";
    protected const PATH = "/v1/carriers/{carrier_id}/services";
    protected const PATH_PARAMS = [
        "carrier_id" => "carrier_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
}
