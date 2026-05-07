<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Billing > Prices > Get list of Prices.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/prices.
 */
class AirwallexBillingGetListOfPrices extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_billing_get_list_of_prices';
    protected const DESCRIPTION = 'Billing > Prices > Get list of Prices.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/prices.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/prices';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
