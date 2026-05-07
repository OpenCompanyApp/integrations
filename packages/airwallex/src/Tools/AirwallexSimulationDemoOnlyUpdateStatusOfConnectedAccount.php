<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Simulation (Demo Only) > Accounts > Update status of connected account.
 *
 * Maps to the official Airwallex endpoint POST /api/v1/simulation/accounts/{account_id}/update_status.
 */
class AirwallexSimulationDemoOnlyUpdateStatusOfConnectedAccount extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_simulation_demo_only_update_status_of_connected_account';
    protected const DESCRIPTION = 'Simulation (Demo Only) > Accounts > Update status of connected account.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/simulation/accounts/{account_id}/update_status.';
    protected const PARAMETERS = [
        'account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `account_id`.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/simulation/accounts/{account_id}/update_status';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'account_id' => 'account_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
