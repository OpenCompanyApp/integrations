<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * List available exchange connections.
 *
 * Maps to the official Dwolla endpoint GET /customers/{id}/available-exchange-connections.
 */
class DwollaListAvailableExchangeConnections extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_list_available_exchange_connections';
    protected const DESCRIPTION = 'Returns available exchange connections for a customer\'s bank accounts authorized through MX Connect. Each connection includes an account name and availableConnectionToken required to create exchanges and funding sources for transfers.

Official Dwolla endpoint: GET /customers/{id}/available-exchange-connections.';
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
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/customers/{id}/available-exchange-connections';
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
