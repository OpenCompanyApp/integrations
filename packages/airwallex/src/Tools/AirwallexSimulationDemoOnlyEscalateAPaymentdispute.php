<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Simulation (Demo Only) > Payment Acceptance > Escalate a PaymentDispute.
 *
 * Maps to the official Airwallex endpoint POST /api/v1/simulation/pa/payment_disputes/{dispute_id}/escalate.
 */
class AirwallexSimulationDemoOnlyEscalateAPaymentdispute extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_simulation_demo_only_escalate_a_paymentdispute';
    protected const DESCRIPTION = 'Simulation (Demo Only) > Payment Acceptance > Escalate a PaymentDispute.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/simulation/pa/payment_disputes/{dispute_id}/escalate.';
    protected const PARAMETERS = [
        'dispute_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `dispute_id`.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/simulation/pa/payment_disputes/{dispute_id}/escalate';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'dispute_id' => 'dispute_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
