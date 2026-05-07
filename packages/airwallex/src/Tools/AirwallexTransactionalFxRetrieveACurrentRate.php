<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Transactional FX > Rates > Retrieve a current rate.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/fx/rates/current.
 */
class AirwallexTransactionalFxRetrieveACurrentRate extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_transactional_fx_retrieve_a_current_rate';
    protected const DESCRIPTION = 'Transactional FX > Rates > Retrieve a current rate.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/fx/rates/current.';
    protected const PARAMETERS = [
        'buy_currency' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Currency (3-letter ISO-4217 code) the client buys',
        ],
        'sell_currency' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Currency (3-letter ISO-4217 code) the client sells. This is the currency you will need to send us by the settlement cutoff time',
        ],
        'buy_amount' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Amount the client buys in buy_currency (must be blank if sell_amount is specified)',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/fx/rates/current';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'buy_currency' => 'buy_currency',
        'sell_currency' => 'sell_currency',
        'buy_amount' => 'buy_amount',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
