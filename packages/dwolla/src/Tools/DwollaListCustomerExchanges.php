<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * List exchanges for a customer.
 *
 * Maps to the official Dwolla endpoint GET /customers/{id}/exchanges.
 */
class DwollaListCustomerExchanges extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_list_customer_exchanges';
    protected const DESCRIPTION = 'Returns all exchanges for a specific customer. Exchanges represent connections between the customer\'s external bank accounts and open banking partners. Includes exchange status, creation date, and links to associated funding sources and partners.

Official Dwolla endpoint: GET /customers/{id}/exchanges.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the Customer to list exchanges for',
        ],
        'accept' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
            'enum' => ['application/vnd.dwolla.v1.hal+json'],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/customers/{id}/exchanges';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'Accept' => 'accept',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
