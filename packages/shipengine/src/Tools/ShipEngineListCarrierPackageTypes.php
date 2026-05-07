<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * List Carrier Package Types.
 *
 * Maps to the official ShipEngine endpoint GET /v1/carriers/{carrier_id}/packages.
 */
class ShipEngineListCarrierPackageTypes extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_list_carrier_package_types";
    protected const DESCRIPTION = "List Carrier Package Types\n\nOfficial ShipEngine endpoint: GET /v1/carriers/{carrier_id}/packages.";
    protected const PARAMETERS = [
        "carrier_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Carrier ID",
        ],
    ];
    protected const METHOD = "GET";
    protected const PATH = "/v1/carriers/{carrier_id}/packages";
    protected const PATH_PARAMS = [
        "carrier_id" => "carrier_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
}
