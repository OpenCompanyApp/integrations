<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Simulation (Demo Only) > Billing > Fail next autocharge.
 *
 * Maps to the official Airwallex endpoint POST /api/v1/simulation/billing/payment_sources/{payment_source_id}/fail_next_autocharge.
 */
class AirwallexSimulationDemoOnlyFailNextAutocharge extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_simulation_demo_only_fail_next_autocharge';
    protected const DESCRIPTION = 'Simulation (Demo Only) > Billing > Fail next autocharge.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/simulation/billing/payment_sources/{payment_source_id}/fail_next_autocharge.';
    protected const PARAMETERS = [
        'payment_source_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `payment_source_id`.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/simulation/billing/payment_sources/{payment_source_id}/fail_next_autocharge';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'payment_source_id' => 'payment_source_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
