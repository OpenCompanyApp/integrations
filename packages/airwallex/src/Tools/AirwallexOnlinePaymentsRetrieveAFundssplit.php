<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Online Payments > Fund Splits > Retrieve a FundsSplit.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/pa/funds_splits/{fund_split_id}.
 */
class AirwallexOnlinePaymentsRetrieveAFundssplit extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_online_payments_retrieve_a_fundssplit';
    protected const DESCRIPTION = 'Online Payments > Fund Splits > Retrieve a FundsSplit.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/pa/funds_splits/{fund_split_id}.';
    protected const PARAMETERS = [
        'fund_split_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `fund_split_id`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/pa/funds_splits/{fund_split_id}';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'fund_split_id' => 'fund_split_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
