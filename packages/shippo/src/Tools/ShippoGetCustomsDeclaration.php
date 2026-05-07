<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * Retrieve a customs declaration.
 *
 * Maps to the official Shippo endpoint GET /customs/declarations/{CustomsDeclarationId}.
 */
class ShippoGetCustomsDeclaration extends AbstractShippoTool
{
    protected const NAME = "shippo_get_customs_declaration";
    protected const DESCRIPTION = "Retrieve a customs declaration\n\nOfficial Shippo endpoint: GET /customs/declarations/{CustomsDeclarationId}.";
    protected const PARAMETERS = [
        "customs_declaration_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Object ID of the customs declaration",
        ],
        "page" => [
            "type" => "integer",
            "required" => false,
            "description" => "The page number you want to select",
        ],
        "shippo_api_version" => [
            "type" => "string",
            "required" => false,
            "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
        ],
    ];
    protected const METHOD = "GET";
    protected const PATH = "/customs/declarations/{CustomsDeclarationId}";
    protected const PATH_PARAMS = [
        "CustomsDeclarationId" => "customs_declaration_id",
    ];
    protected const QUERY_PARAMS = [
        "page" => "page",
    ];
    protected const HEADER_PARAMS = [
        "SHIPPO-API-VERSION" => "shippo_api_version",
    ];
    protected const BODY_REQUIRED = false;
}
