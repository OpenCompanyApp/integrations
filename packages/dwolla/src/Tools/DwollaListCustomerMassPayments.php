<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * List mass payments for customer.
 *
 * Maps to the official Dwolla endpoint GET /customers/{id}/mass-payments.
 */
class DwollaListCustomerMassPayments extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_list_customer_mass_payments';
    protected const DESCRIPTION = 'List mass payments for customer

Official Dwolla endpoint: GET /customers/{id}/mass-payments.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Customer ID to get mass payments for',
        ],
        'correlation_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'A string value to search on if `correlationId` was specified for a transaction',
        ],
        'limit' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Number of search results to return. Defaults to 25',
        ],
        'offset' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Number of search results to skip. Use for pagination',
        ],
        'accept' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
            'enum' => ['application/vnd.dwolla.v1.hal+json'],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/customers/{id}/mass-payments';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [
        'correlationId' => 'correlation_id',
        'limit' => 'limit',
        'offset' => 'offset',
    ];
    protected const HEADER_PARAMS = [
        'Accept' => 'accept',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
