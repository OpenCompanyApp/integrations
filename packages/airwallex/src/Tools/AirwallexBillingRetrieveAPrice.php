<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Billing > Prices > Retrieve a Price.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/prices/{price_id}.
 */
class AirwallexBillingRetrieveAPrice extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_billing_retrieve_a_price';
    protected const DESCRIPTION = 'Billing > Prices > Retrieve a Price.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/prices/{price_id}.';
    protected const PARAMETERS = [
        'price_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `price_id`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/prices/{price_id}';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'price_id' => 'price_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
