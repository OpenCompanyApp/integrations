<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Get Tags.
 *
 * Maps to the official ShipEngine endpoint GET /v1/tags.
 */
class ShipEngineListTags extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_list_tags";
    protected const DESCRIPTION = "Get Tags\n\nOfficial ShipEngine endpoint: GET /v1/tags.";
    protected const PARAMETERS = [];
    protected const METHOD = "GET";
    protected const PATH = "/v1/tags";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
}
