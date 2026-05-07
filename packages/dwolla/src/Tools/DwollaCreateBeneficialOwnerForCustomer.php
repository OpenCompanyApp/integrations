<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Create customer beneficial owner.
 *
 * Maps to the official Dwolla endpoint POST /customers/{id}/beneficial-owners.
 */
class DwollaCreateBeneficialOwnerForCustomer extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_create_beneficial_owner_for_customer';
    protected const DESCRIPTION = 'Creates a new beneficial owner for a business verified customer. Beneficial owners are individuals who own 25% or more of the company\'s equity. Requires personal information, address, and SSN or passport for identity verification.

Official Dwolla endpoint: POST /customers/{id}/beneficial-owners.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Customer ID for which to create a Beneficial Owner',
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
    protected const PATH = '/customers/{id}/beneficial-owners';
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
