<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Delete A Custom Package By ID.
 *
 * Maps to the official ShipEngine endpoint DELETE /v1/packages/{package_id}.
 */
class ShipEngineDeletePackageType extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_delete_package_type";
    protected const DESCRIPTION = "Delete A Custom Package By ID\n\nOfficial ShipEngine endpoint: DELETE /v1/packages/{package_id}.";
    protected const PARAMETERS = [
        "package_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Package ID",
        ],
    ];
    protected const METHOD = "DELETE";
    protected const PATH = "/v1/packages/{package_id}";
    protected const PATH_PARAMS = [
        "package_id" => "package_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
}
