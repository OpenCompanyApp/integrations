<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Scale > Connected Account Transfers > Create a new connected account transfer.
 *
 * Maps to the official Airwallex endpoint POST /api/v1/connected_account_transfers/create.
 */
class AirwallexScaleCreateANewConnectedAccountTransfer extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_scale_create_a_new_connected_account_transfer';
    protected const DESCRIPTION = 'Scale > Connected Account Transfers > Create a new connected account transfer.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/connected_account_transfers/create.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/connected_account_transfers/create';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
