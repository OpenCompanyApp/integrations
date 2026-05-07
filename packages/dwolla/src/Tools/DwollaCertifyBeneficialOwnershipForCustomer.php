<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Certify beneficial ownership.
 *
 * Maps to the official Dwolla endpoint POST /customers/{id}/beneficial-ownership.
 */
class DwollaCertifyBeneficialOwnershipForCustomer extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_certify_beneficial_ownership_for_customer';
    protected const DESCRIPTION = 'Updates the beneficial ownership certification status to "certified", confirming that all beneficial owner information is accurate and complete. This action enables the business customer to send funds and is required to complete the verification process.

Official Dwolla endpoint: POST /customers/{id}/beneficial-ownership.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Customer unique identifier',
        ],
        'accept' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
            'enum' => ['application/vnd.dwolla.v1.hal+json'],
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Dwolla OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/customers/{id}/beneficial-ownership';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'Accept' => 'accept',
    ];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
