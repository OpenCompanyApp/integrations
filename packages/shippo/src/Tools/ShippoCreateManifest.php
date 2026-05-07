<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * Create a new manifest.
 *
 * Maps to the official Shippo endpoint POST /manifests.
 */
class ShippoCreateManifest extends AbstractShippoTool
{
    protected const NAME = "shippo_create_manifest";
    protected const DESCRIPTION = "Create a new manifest\n\nOfficial Shippo endpoint: POST /manifests.";
    protected const PARAMETERS = [
        "shippo_api_version" => [
            "type" => "string",
            "required" => false,
            "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Manifest details and contact info.",
        ],
    ];
    protected const METHOD = "POST";
    protected const PATH = "/manifests";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        "SHIPPO-API-VERSION" => "shippo_api_version",
    ];
    protected const BODY_REQUIRED = true;
}
