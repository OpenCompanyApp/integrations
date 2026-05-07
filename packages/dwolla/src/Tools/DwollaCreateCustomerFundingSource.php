<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Create customer funding source.
 *
 * Maps to the official Dwolla endpoint POST /customers/{id}/funding-sources.
 */
class DwollaCreateCustomerFundingSource extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_create_customer_funding_source';
    protected const DESCRIPTION = 'Creates a bank account or debit card funding source for a customer. Supports multiple methods including manual entry with routing/account numbers, instant verification using existing open banking connections, debit card addition via Exchange, and virtual account numbers. Bank funding sources require verification before transfers can be initiated.

Official Dwolla endpoint: POST /customers/{id}/funding-sources.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Customer\'s unique identifier',
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
    protected const PATH = '/customers/{id}/funding-sources';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'Accept' => 'accept',
    ];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/vnd.dwolla.v1.hal+json';
    protected const AUTH_MODE = 'bearer';
}
