<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * List account mass payments.
 *
 * Maps to the official Dwolla endpoint GET /accounts/{id}/mass-payments.
 */
class DwollaListMassPayments extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_list_mass_payments';
    protected const DESCRIPTION = 'Returns a paginated list of mass payments created by your Main Dwolla account. Results are sorted by creation date in descending order (newest first) and can be filtered by correlation ID.

Official Dwolla endpoint: GET /accounts/{id}/mass-payments.';
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
        'limit' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Maximum number of results to return',
        ],
        'offset' => [
            'type' => 'number',
            'required' => false,
            'description' => 'How many results to skip.',
        ],
        'correlation_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Correlation ID to search by.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/accounts/{id}/mass-payments';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [
        'limit' => 'limit',
        'offset' => 'offset',
        'correlationId' => 'correlation_id',
    ];
    protected const HEADER_PARAMS = [
        'Accept' => 'accept',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
