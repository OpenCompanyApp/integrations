<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Initiate a KBA session.
 *
 * Maps to the official Dwolla endpoint POST /customers/{id}/kba.
 */
class DwollaInitiateKbaForCustomer extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_initiate_kba_for_customer';
    protected const DESCRIPTION = 'Creates a new KBA (Knowledge-Based Authentication) session for a personal Verified Customer. Returns a KBA identifier that represents the session and is used to retrieve authentication questions for customer verification.

Official Dwolla endpoint: POST /customers/{id}/kba.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the Customer for initiating a KBA session',
        ],
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
    protected const PATH = '/customers/{id}/kba';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'Accept' => 'accept',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
