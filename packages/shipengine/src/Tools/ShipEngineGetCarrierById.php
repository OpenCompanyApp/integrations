<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Get Carrier By ID.
 *
 * Maps to the official ShipEngine endpoint GET /v1/carriers/{carrier_id}.
 */
class ShipEngineGetCarrierById extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_get_carrier_by_id";
    protected const DESCRIPTION = "Get Carrier By ID\n\nOfficial ShipEngine endpoint: GET /v1/carriers/{carrier_id}.";
    protected const PARAMETERS = [
        "carrier_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Carrier ID",
        ],
    ];
    protected const METHOD = "GET";
    protected const PATH = "/v1/carriers/{carrier_id}";
    protected const PATH_PARAMS = [
        "carrier_id" => "carrier_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
}
