<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * List and search account transfers.
 *
 * Maps to the official Dwolla endpoint GET /accounts/{id}/transfers.
 */
class DwollaListAndSearchTransfers extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_list_and_search_transfers';
    protected const DESCRIPTION = 'Returns a paginated, searchable list of transfers associated with the specified Main Dwolla account. Supports advanced filtering by amount range, date range, transfer status, and correlation ID. Results are limited to 10,000 transfers per query; use date range filters for historical data beyond this limit.

Official Dwolla endpoint: GET /accounts/{id}/transfers.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Account\'s unique identifier',
        ],
        'accept' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
            'enum' => ['application/vnd.dwolla.v1.hal+json'],
        ],
        'search' => [
            'type' => 'string',
            'required' => false,
            'description' => 'A string to search on fields `firstName`, `lastName`, `email`, `businessName`, Customer ID, and Account ID',
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
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/accounts/{id}/transfers';
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
