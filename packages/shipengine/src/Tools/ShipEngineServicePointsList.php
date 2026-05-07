<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * List Service Points.
 *
 * Maps to the official ShipEngine endpoint POST /v1/service_points/list.
 */
class ShipEngineServicePointsList extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_service_points_list";
    protected const DESCRIPTION = "List Service Points\n\nOfficial ShipEngine endpoint: POST /v1/service_points/list.";
    protected const PARAMETERS = [
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "JSON request body matching the official ShipEngine schema for List Service Points.",
        ],
    ];
    protected const METHOD = "POST";
    protected const PATH = "/v1/service_points/list";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
}
