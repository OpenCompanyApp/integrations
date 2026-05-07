<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * List customer beneficial owners.
 *
 * Maps to the official Dwolla endpoint GET /customers/{id}/beneficial-owners.
 */
class DwollaListBeneficialOwnersForCustomer extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_list_beneficial_owners_for_customer';
    protected const DESCRIPTION = 'Returns all beneficial owners associated with a business verified customer. Beneficial owners are individuals who directly or indirectly own 25% or more of the company\'s equity. Includes personal information, verification status, and address details for each owner.

Official Dwolla endpoint: GET /customers/{id}/beneficial-owners.';
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
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/customers/{id}/beneficial-owners';
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
