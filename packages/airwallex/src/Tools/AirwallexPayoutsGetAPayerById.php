<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Payouts > Payers > Get a payer by ID.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/payers/{payer_id}.
 */
class AirwallexPayoutsGetAPayerById extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_payouts_get_a_payer_by_id';
    protected const DESCRIPTION = 'Payouts > Payers > Get a payer by ID.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/payers/{payer_id}.';
    protected const PARAMETERS = [
        'payer_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `payer_id`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/payers/{payer_id}';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'payer_id' => 'payer_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
