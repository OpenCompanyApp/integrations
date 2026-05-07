<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Add Funds To Insurance.
 *
 * Maps to the official ShipEngine endpoint PATCH /v1/insurance/shipsurance/add_funds.
 */
class ShipEngineAddFundsToInsurance extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_add_funds_to_insurance";
    protected const DESCRIPTION = "Add Funds To Insurance\n\nOfficial ShipEngine endpoint: PATCH /v1/insurance/shipsurance/add_funds.";
    protected const PARAMETERS = [
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "JSON request body matching the official ShipEngine schema for Add Funds To Insurance.",
        ],
    ];
    protected const METHOD = "PATCH";
    protected const PATH = "/v1/insurance/shipsurance/add_funds";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
}
