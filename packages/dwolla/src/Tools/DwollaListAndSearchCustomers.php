<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * List and search customers.
 *
 * Maps to the official Dwolla endpoint GET /customers.
 */
class DwollaListAndSearchCustomers extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_list_and_search_customers';
    protected const DESCRIPTION = 'Returns a paginated list of customers sorted by creation date. Supports fuzzy search across customer names, business names, and email addresses, plus exact filtering by email and verification status. Default limit is 25 customers per page, maximum 200.

Official Dwolla endpoint: GET /customers.';
    protected const PARAMETERS = [
        'limit' => [
            'type' => 'number',
            'required' => false,
            'description' => 'How many results to return',
        ],
        'offset' => [
            'type' => 'number',
            'required' => false,
            'description' => 'How many results to skip',
        ],
        'search' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Searches on certain fields',
        ],
        'status' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Filter by customer status',
        ],
        'accept' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
            'enum' => ['application/vnd.dwolla.v1.hal+json'],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/customers';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'limit' => 'limit',
        'offset' => 'offset',
        'search' => 'search',
        'status' => 'status',
    ];
    protected const HEADER_PARAMS = [
        'Accept' => 'accept',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
