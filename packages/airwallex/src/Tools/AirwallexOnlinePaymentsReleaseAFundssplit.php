<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Online Payments > Fund Splits > Release a FundsSplit.
 *
 * Maps to the official Airwallex endpoint POST /api/v1/pa/funds_splits/{fund_split_id}/release.
 */
class AirwallexOnlinePaymentsReleaseAFundssplit extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_online_payments_release_a_fundssplit';
    protected const DESCRIPTION = 'Online Payments > Fund Splits > Release a FundsSplit.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/pa/funds_splits/{fund_split_id}/release.';
    protected const PARAMETERS = [
        'fund_split_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `fund_split_id`.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/pa/funds_splits/{fund_split_id}/release';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'fund_split_id' => 'fund_split_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
