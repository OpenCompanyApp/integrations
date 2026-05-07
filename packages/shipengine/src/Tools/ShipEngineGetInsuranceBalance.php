<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Get Insurance Funds Balance.
 *
 * Maps to the official ShipEngine endpoint GET /v1/insurance/shipsurance/balance.
 */
class ShipEngineGetInsuranceBalance extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_get_insurance_balance";
    protected const DESCRIPTION = "Get Insurance Funds Balance\n\nOfficial ShipEngine endpoint: GET /v1/insurance/shipsurance/balance.";
    protected const PARAMETERS = [];
    protected const METHOD = "GET";
    protected const PATH = "/v1/insurance/shipsurance/balance";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
}
