<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Create Custom Package Type.
 *
 * Maps to the official ShipEngine endpoint POST /v1/packages.
 */
class ShipEngineCreatePackageType extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_create_package_type";
    protected const DESCRIPTION = "Create Custom Package Type\n\nOfficial ShipEngine endpoint: POST /v1/packages.";
    protected const PARAMETERS = [
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "JSON request body matching the official ShipEngine schema for Create Custom Package Type.",
        ],
    ];
    protected const METHOD = "POST";
    protected const PATH = "/v1/packages";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
}
