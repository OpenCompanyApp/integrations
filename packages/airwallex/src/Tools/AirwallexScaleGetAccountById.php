<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Scale > Accounts > Get account by ID.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/accounts/{connected_account_id}.
 */
class AirwallexScaleGetAccountById extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_scale_get_account_by_id';
    protected const DESCRIPTION = 'Scale > Accounts > Get account by ID.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/accounts/{connected_account_id}.';
    protected const PARAMETERS = [
        'connected_account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `connected_account_id`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/accounts/{connected_account_id}';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'connected_account_id' => 'connected_account_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
