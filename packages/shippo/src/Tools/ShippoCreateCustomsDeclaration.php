<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * Create a new customs declaration.
 *
 * Maps to the official Shippo endpoint POST /customs/declarations.
 */
class ShippoCreateCustomsDeclaration extends AbstractShippoTool
{
    protected const NAME = "shippo_create_customs_declaration";
    protected const DESCRIPTION = "Create a new customs declaration\n\nOfficial Shippo endpoint: POST /customs/declarations.";
    protected const PARAMETERS = [
        "shippo_api_version" => [
            "type" => "string",
            "required" => false,
            "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "CustomsDeclaration details.",
        ],
    ];
    protected const METHOD = "POST";
    protected const PATH = "/customs/declarations";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        "SHIPPO-API-VERSION" => "shippo_api_version",
    ];
    protected const BODY_REQUIRED = true;
}
