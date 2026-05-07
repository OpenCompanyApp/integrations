<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Simulate a scenario.
 *
 * Maps to the official GoCardless endpoint POST /scenario_simulators/{scenario_simulator_id}/actions/run.
 */
class GoCardlessRunScenarioSimulator extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_run_scenario_simulator';
    protected const DESCRIPTION = 'Runs the specific scenario simulator against the specific resource

Official GoCardless endpoint: POST /scenario_simulators/{scenario_simulator_id}/actions/run.';
    protected const PARAMETERS = [
        'scenario_simulator_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The scenario simulator id',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official GoCardless OpenAPI schema.',
        ],
        'idempotency_key' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/scenario_simulators/{scenario_simulator_id}/actions/run';
    protected const PATH_PARAMS = [
        'scenario_simulator_id' => 'scenario_simulator_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
