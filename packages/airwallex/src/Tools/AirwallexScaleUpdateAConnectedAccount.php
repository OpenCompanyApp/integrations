<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Scale > Accounts > Update a connected account.
 *
 * Maps to the official Airwallex endpoint POST /api/v1/accounts/{connected_account_id}/update.
 */
class AirwallexScaleUpdateAConnectedAccount extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_scale_update_a_connected_account';
    protected const DESCRIPTION = 'Scale > Accounts > Update a connected account.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/accounts/{connected_account_id}/update.';
    protected const PARAMETERS = [
        'connected_account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `connected_account_id`.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/accounts/{connected_account_id}/update';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'connected_account_id' => 'connected_account_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
