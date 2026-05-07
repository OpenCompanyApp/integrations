<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Simulation (Demo Only) > Transfers > Transition Transfer Status.
 *
 * Maps to the official Airwallex endpoint POST /api/v1/simulation/transfers/{transfer_id}/transition.
 */
class AirwallexSimulationDemoOnlyTransitionTransferStatus extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_simulation_demo_only_transition_transfer_status';
    protected const DESCRIPTION = 'Simulation (Demo Only) > Transfers > Transition Transfer Status.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/simulation/transfers/{transfer_id}/transition.';
    protected const PARAMETERS = [
        'transfer_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `transfer_id`.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/simulation/transfers/{transfer_id}/transition';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'transfer_id' => 'transfer_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
