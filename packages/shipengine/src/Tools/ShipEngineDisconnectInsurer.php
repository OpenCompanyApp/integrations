<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Disconnect a Shipsurance Account.
 *
 * Maps to the official ShipEngine endpoint DELETE /v1/connections/insurance/shipsurance.
 */
class ShipEngineDisconnectInsurer extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_disconnect_insurer";
    protected const DESCRIPTION = "Disconnect a Shipsurance Account\n\nOfficial ShipEngine endpoint: DELETE /v1/connections/insurance/shipsurance.";
    protected const PARAMETERS = [];
    protected const METHOD = "DELETE";
    protected const PATH = "/v1/connections/insurance/shipsurance";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
}
