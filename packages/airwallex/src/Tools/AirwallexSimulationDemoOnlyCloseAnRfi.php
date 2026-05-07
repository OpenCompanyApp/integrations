<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Simulation (Demo Only) > Request for Information (RFI) > Close an RFI.
 *
 * Maps to the official Airwallex endpoint POST /api/v1/simulation/rfis/{rfi_id}/close.
 */
class AirwallexSimulationDemoOnlyCloseAnRfi extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_simulation_demo_only_close_an_rfi';
    protected const DESCRIPTION = 'Simulation (Demo Only) > Request for Information (RFI) > Close an RFI.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/simulation/rfis/{rfi_id}/close.';
    protected const PARAMETERS = [
        'rfi_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `rfi_id`.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/simulation/rfis/{rfi_id}/close';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'rfi_id' => 'rfi_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
