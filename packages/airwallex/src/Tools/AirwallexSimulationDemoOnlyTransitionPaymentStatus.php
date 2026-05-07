<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Simulation (Demo Only) > Payouts > Transition Payment Status.
 *
 * Maps to the official Airwallex endpoint POST /api/v1/simulation/payments/{id}/transition.
 */
class AirwallexSimulationDemoOnlyTransitionPaymentStatus extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_simulation_demo_only_transition_payment_status';
    protected const DESCRIPTION = 'Simulation (Demo Only) > Payouts > Transition Payment Status.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/simulation/payments/{id}/transition.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `id`.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/simulation/payments/{id}/transition';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
