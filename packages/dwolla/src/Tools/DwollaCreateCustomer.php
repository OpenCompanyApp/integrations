<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Create a customer.
 *
 * Maps to the official Dwolla endpoint POST /customers.
 */
class DwollaCreateCustomer extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_create_customer';
    protected const DESCRIPTION = 'Creates a new customer with different verification levels and capabilities. Supports personal verified customers (individuals), business verified customers (businesses), unverified customers, and receive-only users. Customer type determines transaction limits, verification requirements, and available features.

Official Dwolla endpoint: POST /customers.';
    protected const PARAMETERS = [
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
    protected const PATH = '/customers';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'Accept' => 'accept',
    ];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/vnd.dwolla.v1.hal+json';
    protected const AUTH_MODE = 'bearer';
}
