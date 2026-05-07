<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Create a New Tag.
 *
 * Maps to the official ShipEngine endpoint POST /v1/tags.
 */
class ShipEngineCreateTag extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_create_tag";
    protected const DESCRIPTION = "Create a New Tag\n\nOfficial ShipEngine endpoint: POST /v1/tags.";
    protected const PARAMETERS = [
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "JSON request body matching the official ShipEngine schema for Create a New Tag.",
        ],
    ];
    protected const METHOD = "POST";
    protected const PATH = "/v1/tags";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
}
