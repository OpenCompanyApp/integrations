<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Create an Account Image.
 *
 * Maps to the official ShipEngine endpoint POST /v1/account/settings/images.
 */
class ShipEngineCreateAccountImage extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_create_account_image";
    protected const DESCRIPTION = "Create an Account Image\n\nOfficial ShipEngine endpoint: POST /v1/account/settings/images.";
    protected const PARAMETERS = [
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "JSON request body matching the official ShipEngine schema for Create an Account Image.",
        ],
    ];
    protected const METHOD = "POST";
    protected const PATH = "/v1/account/settings/images";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
}
