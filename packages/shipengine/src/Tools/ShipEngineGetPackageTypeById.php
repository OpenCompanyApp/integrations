<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Get Custom Package Type By ID.
 *
 * Maps to the official ShipEngine endpoint GET /v1/packages/{package_id}.
 */
class ShipEngineGetPackageTypeById extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_get_package_type_by_id";
    protected const DESCRIPTION = "Get Custom Package Type By ID\n\nOfficial ShipEngine endpoint: GET /v1/packages/{package_id}.";
    protected const PARAMETERS = [
        "package_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Package ID",
        ],
    ];
    protected const METHOD = "GET";
    protected const PATH = "/v1/packages/{package_id}";
    protected const PATH_PARAMS = [
        "package_id" => "package_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
}
