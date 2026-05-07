<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Payouts > Payers > Get list of payers.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/payers.
 */
class AirwallexPayoutsGetListOfPayers extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_payouts_get_list_of_payers';
    protected const DESCRIPTION = 'Payouts > Payers > Get list of payers.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/payers.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/payers';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
