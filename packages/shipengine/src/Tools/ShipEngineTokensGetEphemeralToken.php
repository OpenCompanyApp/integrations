<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Get Ephemeral Token.
 *
 * Maps to the official ShipEngine endpoint POST /v1/tokens/ephemeral.
 */
class ShipEngineTokensGetEphemeralToken extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_tokens_get_ephemeral_token";
    protected const DESCRIPTION = "Get Ephemeral Token\n\nOfficial ShipEngine endpoint: POST /v1/tokens/ephemeral.";
    protected const PARAMETERS = [
        "redirect" => [
            "type" => "string",
            "enum" => [
                "shipengine-dashboard",
            ],
            "required" => false,
            "description" => "Include a redirect url to the application formatted with the ephemeral token.",
        ],
    ];
    protected const METHOD = "POST";
    protected const PATH = "/v1/tokens/ephemeral";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        "redirect" => "redirect",
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
}
