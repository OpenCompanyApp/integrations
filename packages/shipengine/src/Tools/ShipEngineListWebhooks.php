<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * List Webhooks.
 *
 * Maps to the official ShipEngine endpoint GET /v1/environment/webhooks.
 */
class ShipEngineListWebhooks extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_list_webhooks";
    protected const DESCRIPTION = "List Webhooks\n\nOfficial ShipEngine endpoint: GET /v1/environment/webhooks.";
    protected const PARAMETERS = [];
    protected const METHOD = "GET";
    protected const PATH = "/v1/environment/webhooks";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
}
