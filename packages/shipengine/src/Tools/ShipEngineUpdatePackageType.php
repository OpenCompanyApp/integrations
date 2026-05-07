<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Update Custom Package Type By ID.
 *
 * Maps to the official ShipEngine endpoint PUT /v1/packages/{package_id}.
 */
class ShipEngineUpdatePackageType extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_update_package_type";
    protected const DESCRIPTION = "Update Custom Package Type By ID\n\nOfficial ShipEngine endpoint: PUT /v1/packages/{package_id}.";
    protected const PARAMETERS = [
        "package_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Package ID",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "JSON request body matching the official ShipEngine schema for Update Custom Package Type By ID.",
        ],
    ];
    protected const METHOD = "PUT";
    protected const PATH = "/v1/packages/{package_id}";
    protected const PATH_PARAMS = [
        "package_id" => "package_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
}
