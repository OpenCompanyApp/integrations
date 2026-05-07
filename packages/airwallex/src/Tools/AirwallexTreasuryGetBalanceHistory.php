<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Treasury > Balances > Get balance history.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/balances/history.
 */
class AirwallexTreasuryGetBalanceHistory extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_treasury_get_balance_history';
    protected const DESCRIPTION = 'Treasury > Balances > Get balance history.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/balances/history.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/balances/history';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
