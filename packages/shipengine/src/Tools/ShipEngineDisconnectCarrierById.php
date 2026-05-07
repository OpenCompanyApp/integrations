<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Disconnect Carrier by ID.
 *
 * Maps to the official ShipEngine endpoint DELETE /v1/carriers/{carrier_id}.
 */
class ShipEngineDisconnectCarrierById extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_disconnect_carrier_by_id";
    protected const DESCRIPTION = "Disconnect Carrier by ID\n\nOfficial ShipEngine endpoint: DELETE /v1/carriers/{carrier_id}.";
    protected const PARAMETERS = [
        "carrier_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Carrier ID",
        ],
    ];
    protected const METHOD = "DELETE";
    protected const PATH = "/v1/carriers/{carrier_id}";
    protected const PATH_PARAMS = [
        "carrier_id" => "carrier_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
}
