<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Purchase Label.
 *
 * Maps to the official ShipEngine endpoint POST /v1/labels.
 */
class ShipEngineCreateLabel extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_create_label";
    protected const DESCRIPTION = "Purchase Label\n\nOfficial ShipEngine endpoint: POST /v1/labels.";
    protected const PARAMETERS = [
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "JSON request body matching the official ShipEngine schema for Purchase Label.",
        ],
    ];
    protected const METHOD = "POST";
    protected const PATH = "/v1/labels";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
}
