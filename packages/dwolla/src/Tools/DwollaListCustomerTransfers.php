<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * List and search transfers for a customer.
 *
 * Maps to the official Dwolla endpoint GET /customers/{id}/transfers.
 */
class DwollaListCustomerTransfers extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_list_customer_transfers';
    protected const DESCRIPTION = 'List and search transfers for a customer

Official Dwolla endpoint: GET /customers/{id}/transfers.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Customer\'s unique identifier',
        ],
        'search' => [
            'type' => 'string',
            'required' => false,
            'description' => 'A string to search on fields `firstName`, `lastName`, `email`, `businessName`',
        ],
        'start_amount' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Only include transactions with an amount equal to or greater than `startAmount`',
        ],
        'end_amount' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Only include transactions with an amount equal to or less than `endAmount`',
        ],
        'start_date' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Only include transactions created after this date. ISO-8601 format `YYYY-MM-DD`',
        ],
        'end_date' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Only include transactions created before this date. ISO-8601 format `YYYY-MM-DD`',
        ],
        'status' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Filter on transaction status. Possible values are `pending`, `processed`, `failed`, or `cancelled`',
        ],
        'correlation_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'A string value to search on if `correlationId` was specified for a transaction',
        ],
        'limit' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Number of search results to return. Defaults to 25',
        ],
        'offset' => [
            'type' => 'string',
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
    protected const PATH = '/customers/{id}/transfers';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [
        'search' => 'search',
        'startAmount' => 'start_amount',
        'endAmount' => 'end_amount',
        'startDate' => 'start_date',
        'endDate' => 'end_date',
        'status' => 'status',
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
