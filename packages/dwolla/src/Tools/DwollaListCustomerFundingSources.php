<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * List customer funding sources.
 *
 * Maps to the official Dwolla endpoint GET /customers/{id}/funding-sources.
 */
class DwollaListCustomerFundingSources extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_list_customer_funding_sources';
    protected const DESCRIPTION = 'Returns all funding sources for a customer, including bank accounts, debit card funding sources, and Dwolla balance (verified customers only). Shows verification status, limited account details, and creation dates. Card funding sources include masked card information. Supports filtering to exclude removed funding sources using the removed parameter.

Official Dwolla endpoint: GET /customers/{id}/funding-sources.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Customer\'s unique identifier',
        ],
        'removed' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Filter removed funding sources. Boolean value. Defaults to `true`',
        ],
        'accept' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
            'enum' => ['application/vnd.dwolla.v1.hal+json'],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/customers/{id}/funding-sources';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [
        'removed' => 'removed',
    ];
    protected const HEADER_PARAMS = [
        'Accept' => 'accept',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
