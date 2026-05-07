<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Retrieve beneficial ownership status.
 *
 * Maps to the official Dwolla endpoint GET /customers/{id}/beneficial-ownership.
 */
class DwollaGetBeneficialOwnershipStatusForCustomer extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_get_beneficial_ownership_status_for_customer';
    protected const DESCRIPTION = 'Returns the certification status of beneficial ownership for a business verified customer. Status indicates whether beneficial owner information has been certified and affects the customer\'s ability to send funds. Possible values include uncertified, certified, and recertify.

Official Dwolla endpoint: GET /customers/{id}/beneficial-ownership.';
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
    protected const PATH = '/customers/{id}/beneficial-ownership';
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
