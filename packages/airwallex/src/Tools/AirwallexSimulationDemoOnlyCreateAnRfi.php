<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Simulation (Demo Only) > Request for Information (RFI) > Create an RFI.
 *
 * Maps to the official Airwallex endpoint POST /api/v1/simulation/rfis/create.
 */
class AirwallexSimulationDemoOnlyCreateAnRfi extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_simulation_demo_only_create_an_rfi';
    protected const DESCRIPTION = 'Simulation (Demo Only) > Request for Information (RFI) > Create an RFI.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/simulation/rfis/create.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/simulation/rfis/create';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
