<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Retrieve exchange session.
 *
 * Maps to the official Dwolla endpoint GET /exchange-sessions/{id}.
 */
class DwollaRetrieveCustomerExchangeSession extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_retrieve_customer_exchange_session';
    protected const DESCRIPTION = 'Retrieve exchange session

Official Dwolla endpoint: GET /exchange-sessions/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Exchange session\'s unique identifier',
        ],
        'accept' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
            'enum' => ['application/vnd.dwolla.v1.hal+json'],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/exchange-sessions/{id}';
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
