<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Get Rate By ID.
 *
 * Maps to the official ShipEngine endpoint GET /v1/rates/{rate_id}.
 */
class ShipEngineGetRateById extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_get_rate_by_id";
    protected const DESCRIPTION = "Get Rate By ID\n\nOfficial ShipEngine endpoint: GET /v1/rates/{rate_id}.";
    protected const PARAMETERS = [
        "rate_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Rate ID",
        ],
    ];
    protected const METHOD = "GET";
    protected const PATH = "/v1/rates/{rate_id}";
    protected const PATH_PARAMS = [
        "rate_id" => "rate_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
}
