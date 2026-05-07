<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * Generate a live rates request.
 *
 * Maps to the official Shippo endpoint POST /live-rates.
 */
class ShippoCreateLiveRate extends AbstractShippoTool
{
    protected const NAME = "shippo_create_live_rate";
    protected const DESCRIPTION = "Generate a live rates request\n\nOfficial Shippo endpoint: POST /live-rates.";
    protected const PARAMETERS = [
        "shippo_api_version" => [
            "type" => "string",
            "required" => false,
            "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Generate rates at checkout",
        ],
    ];
    protected const METHOD = "POST";
    protected const PATH = "/live-rates";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        "SHIPPO-API-VERSION" => "shippo_api_version",
    ];
    protected const BODY_REQUIRED = true;
}
