<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Get Service Point By ID.
 *
 * Maps to the official ShipEngine endpoint GET /v1/service_points/{carrier_code}/{country_code}/{service_point_id}.
 */
class ShipEngineServicePointsGetById extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_service_points_get_by_id";
    protected const DESCRIPTION = "Get Service Point By ID\n\nOfficial ShipEngine endpoint: GET /v1/service_points/{carrier_code}/{country_code}/{service_point_id}.";
    protected const PARAMETERS = [
        "carrier_code" => [
            "type" => "string",
            "required" => true,
            "description" => "Carrier code",
        ],
        "country_code" => [
            "type" => "string",
            "required" => true,
            "description" => "A two-letter",
        ],
        "service_point_id" => [
            "type" => "string",
            "required" => true,
            "description" => "path parameter `service_point_id`.",
        ],
    ];
    protected const METHOD = "GET";
    protected const PATH = "/v1/service_points/{carrier_code}/{country_code}/{service_point_id}";
    protected const PATH_PARAMS = [
        "carrier_code" => "carrier_code",
        "country_code" => "country_code",
        "service_point_id" => "service_point_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
}
