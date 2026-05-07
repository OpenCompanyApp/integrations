<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Simulation (Demo Only) > Deposits > Reject a direct debit deposit.
 *
 * Maps to the official Airwallex endpoint POST /api/v1/simulation/deposits/{deposit_id}/reject.
 */
class AirwallexSimulationDemoOnlyRejectADirectDebitDeposit extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_simulation_demo_only_reject_a_direct_debit_deposit';
    protected const DESCRIPTION = 'Simulation (Demo Only) > Deposits > Reject a direct debit deposit.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/simulation/deposits/{deposit_id}/reject.';
    protected const PARAMETERS = [
        'deposit_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `deposit_id`.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/simulation/deposits/{deposit_id}/reject';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'deposit_id' => 'deposit_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
