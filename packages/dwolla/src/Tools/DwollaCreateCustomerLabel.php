<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Create a label for a customer.
 *
 * Maps to the official Dwolla endpoint POST /customers/{id}/labels.
 */
class DwollaCreateCustomerLabel extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_create_customer_label';
    protected const DESCRIPTION = 'Creates a new label for a Verified Customer with a specified amount. Labels help organize and track funds within a customer\'s balance. Returns the location of the created label resource in the response header.

Official Dwolla endpoint: POST /customers/{id}/labels.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'ID of customer to create a label for',
        ],
        'accept' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
            'enum' => ['application/vnd.dwolla.v1.hal+json'],
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Dwolla OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/customers/{id}/labels';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'Accept' => 'accept',
    ];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
