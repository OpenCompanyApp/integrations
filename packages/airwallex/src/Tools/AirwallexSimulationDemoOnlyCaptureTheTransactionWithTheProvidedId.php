<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Simulation (Demo Only) > Issuing > Capture the transaction with the provided id.
 *
 * Maps to the official Airwallex endpoint POST /api/v1/simulation/issuing/{transaction_id}/capture.
 */
class AirwallexSimulationDemoOnlyCaptureTheTransactionWithTheProvidedId extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_simulation_demo_only_capture_the_transaction_with_the_provided_id';
    protected const DESCRIPTION = 'Simulation (Demo Only) > Issuing > Capture the transaction with the provided id.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/simulation/issuing/{transaction_id}/capture.';
    protected const PARAMETERS = [
        'transaction_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `transaction_id`.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/simulation/issuing/{transaction_id}/capture';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'transaction_id' => 'transaction_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
