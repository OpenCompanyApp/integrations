<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * Retrieve a rate.
 *
 * Maps to the official Shippo endpoint GET /rates/{RateId}.
 */
class ShippoGetRate extends AbstractShippoTool
{
    protected const NAME = "shippo_get_rate";
    protected const DESCRIPTION = "Retrieve a rate\n\nOfficial Shippo endpoint: GET /rates/{RateId}.";
    protected const PARAMETERS = [
        "rate_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Object ID of the rate",
        ],
        "shippo_api_version" => [
            "type" => "string",
            "required" => false,
            "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
        ],
    ];
    protected const METHOD = "GET";
    protected const PATH = "/rates/{RateId}";
    protected const PATH_PARAMS = [
        "RateId" => "rate_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        "SHIPPO-API-VERSION" => "shippo_api_version",
    ];
    protected const BODY_REQUIRED = false;
}
