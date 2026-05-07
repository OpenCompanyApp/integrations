<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Validate An Address.
 *
 * Maps to the official ShipEngine endpoint POST /v1/addresses/validate.
 */
class ShipEngineValidateAddress extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_validate_address";
    protected const DESCRIPTION = "Validate An Address\n\nOfficial ShipEngine endpoint: POST /v1/addresses/validate.";
    protected const PARAMETERS = [
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "JSON request body matching the official ShipEngine schema for Validate An Address.",
        ],
    ];
    protected const METHOD = "POST";
    protected const PATH = "/v1/addresses/validate";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
}
