<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Create Manifest.
 *
 * Maps to the official ShipEngine endpoint POST /v1/manifests.
 */
class ShipEngineCreateManifest extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_create_manifest";
    protected const DESCRIPTION = "Create Manifest\n\nOfficial ShipEngine endpoint: POST /v1/manifests.";
    protected const PARAMETERS = [
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "JSON request body matching the official ShipEngine schema for Create Manifest.",
        ],
    ];
    protected const METHOD = "POST";
    protected const PATH = "/v1/manifests";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
}
