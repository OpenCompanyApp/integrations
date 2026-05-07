<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Treasury > Deposits > Get a deposit by ID.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/deposits/{deposit_id}.
 */
class AirwallexTreasuryGetADepositById extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_treasury_get_a_deposit_by_id';
    protected const DESCRIPTION = 'Treasury > Deposits > Get a deposit by ID.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/deposits/{deposit_id}.';
    protected const PARAMETERS = [
        'deposit_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `deposit_id`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/deposits/{deposit_id}';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'deposit_id' => 'deposit_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
