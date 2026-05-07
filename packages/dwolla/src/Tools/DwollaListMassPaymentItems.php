<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * List items for a mass payment.
 *
 * Maps to the official Dwolla endpoint GET /mass-payments/{id}/items.
 */
class DwollaListMassPaymentItems extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_list_mass_payment_items';
    protected const DESCRIPTION = 'Retrieve individual payment items within a mass payment with optional status filtering and pagination support. Each item represents a distinct payment with status indicators (failed, pending, success) showing whether a transfer was successfully created. Returns paginated item details including amount, destination, metadata, and error information for failed items. Supports filtering by status and standard pagination.

Official Dwolla endpoint: GET /mass-payments/{id}/items.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Mass payment unique identifier',
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
        'status' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Filter by item status',
        ],
        'accept' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
            'enum' => ['application/vnd.dwolla.v1.hal+json'],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/mass-payments/{id}/items';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [
        'limit' => 'limit',
        'offset' => 'offset',
        'status' => 'status',
    ];
    protected const HEADER_PARAMS = [
        'Accept' => 'accept',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
