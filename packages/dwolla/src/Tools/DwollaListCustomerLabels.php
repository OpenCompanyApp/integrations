<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * List labels for a customer.
 *
 * Maps to the official Dwolla endpoint GET /customers/{id}/labels.
 */
class DwollaListCustomerLabels extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_list_customer_labels';
    protected const DESCRIPTION = 'Returns all labels for a specified Verified Customer, sorted by creation date (most recent first). Supports pagination with limit and offset parameters. Each label includes its current amount and creation timestamp.

Official Dwolla endpoint: GET /customers/{id}/labels.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'ID of customer',
        ],
        'limit' => [
            'type' => 'string',
            'required' => false,
            'description' => 'How many results to return',
        ],
        'offset' => [
            'type' => 'string',
            'required' => false,
            'description' => 'How many results to skip',
        ],
        'accept' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
            'enum' => ['application/vnd.dwolla.v1.hal+json'],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/customers/{id}/labels';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [
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
