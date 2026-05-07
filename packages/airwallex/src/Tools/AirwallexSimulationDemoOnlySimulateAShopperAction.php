<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Simulation (Demo Only) > Payment Acceptance > Simulate a shopper action.
 *
 * Maps to the official Airwallex endpoint POST /api/v1/simulation/pa/shopper_actions/{action}.
 */
class AirwallexSimulationDemoOnlySimulateAShopperAction extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_simulation_demo_only_simulate_a_shopper_action';
    protected const DESCRIPTION = 'Simulation (Demo Only) > Payment Acceptance > Simulate a shopper action.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/simulation/pa/shopper_actions/{action}.';
    protected const PARAMETERS = [
        'action' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `action`.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/simulation/pa/shopper_actions/{action}';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'action' => 'action',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
