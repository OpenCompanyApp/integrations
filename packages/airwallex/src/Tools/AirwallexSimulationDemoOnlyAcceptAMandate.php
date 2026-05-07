<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Simulation (Demo Only) > Linked Accounts > Accept a Mandate.
 *
 * Maps to the official Airwallex endpoint POST /api/v1/simulation/linked_accounts/{linked_account_id}/mandate/accept.
 */
class AirwallexSimulationDemoOnlyAcceptAMandate extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_simulation_demo_only_accept_a_mandate';
    protected const DESCRIPTION = 'Simulation (Demo Only) > Linked Accounts > Accept a Mandate.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/simulation/linked_accounts/{linked_account_id}/mandate/accept.';
    protected const PARAMETERS = [
        'linked_account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `linked_account_id`.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/simulation/linked_accounts/{linked_account_id}/mandate/accept';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'linked_account_id' => 'linked_account_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
