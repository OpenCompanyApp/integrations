<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Estimate Rates.
 *
 * Maps to the official ShipEngine endpoint POST /v1/rates/estimate.
 */
class ShipEngineEstimateRates extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_estimate_rates";
    protected const DESCRIPTION = "Estimate Rates\n\nOfficial ShipEngine endpoint: POST /v1/rates/estimate.";
    protected const PARAMETERS = [
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "JSON request body matching the official ShipEngine schema for Estimate Rates.",
        ],
    ];
    protected const METHOD = "POST";
    protected const PATH = "/v1/rates/estimate";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
}
