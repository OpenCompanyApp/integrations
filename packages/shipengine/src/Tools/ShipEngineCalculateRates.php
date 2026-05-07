<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Get Shipping Rates.
 *
 * Maps to the official ShipEngine endpoint POST /v1/rates.
 */
class ShipEngineCalculateRates extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_calculate_rates";
    protected const DESCRIPTION = "Get Shipping Rates\n\nOfficial ShipEngine endpoint: POST /v1/rates.";
    protected const PARAMETERS = [
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "JSON request body matching the official ShipEngine schema for Get Shipping Rates.",
        ],
    ];
    protected const METHOD = "POST";
    protected const PATH = "/v1/rates";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
}
