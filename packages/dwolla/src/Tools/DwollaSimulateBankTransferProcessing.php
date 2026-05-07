<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Sandbox simulations (bank transfers, VAN transfers, or customer verification directives).
 *
 * Maps to the official Dwolla endpoint POST /sandbox-simulations.
 */
class DwollaSimulateBankTransferProcessing extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_simulate_bank_transfer_processing';
    protected const DESCRIPTION = 'Sandbox simulations (bank transfers, VAN transfers, or customer verification directives)

Official Dwolla endpoint: POST /sandbox-simulations.';
    protected const PARAMETERS = [
        'accept' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
            'enum' => ['application/vnd.dwolla.v1.hal+json'],
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official Dwolla OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/sandbox-simulations';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'Accept' => 'accept',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/vnd.dwolla.v1.hal+json';
    protected const AUTH_MODE = 'bearer';
}
