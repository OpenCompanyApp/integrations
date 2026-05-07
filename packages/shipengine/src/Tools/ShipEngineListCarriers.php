<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * List Carriers.
 *
 * Maps to the official ShipEngine endpoint GET /v1/carriers.
 */
class ShipEngineListCarriers extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_list_carriers";
    protected const DESCRIPTION = "List Carriers\n\nOfficial ShipEngine endpoint: GET /v1/carriers.";
    protected const PARAMETERS = [];
    protected const METHOD = "GET";
    protected const PATH = "/v1/carriers";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
}
