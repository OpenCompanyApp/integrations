<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Connect a Shipsurance Account.
 *
 * Maps to the official ShipEngine endpoint POST /v1/connections/insurance/shipsurance.
 */
class ShipEngineConnectInsurer extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_connect_insurer";
    protected const DESCRIPTION = "Connect a Shipsurance Account\n\nOfficial ShipEngine endpoint: POST /v1/connections/insurance/shipsurance.";
    protected const PARAMETERS = [
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "JSON request body matching the official ShipEngine schema for Connect a Shipsurance Account.",
        ],
    ];
    protected const METHOD = "POST";
    protected const PATH = "/v1/connections/insurance/shipsurance";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
}
