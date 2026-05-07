<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Online Payments > Fund Splits > Get list of FundsSplits.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/pa/funds_splits.
 */
class AirwallexOnlinePaymentsGetListOfFundssplits extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_online_payments_get_list_of_fundssplits';
    protected const DESCRIPTION = 'Online Payments > Fund Splits > Get list of FundsSplits.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/pa/funds_splits.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/pa/funds_splits';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
