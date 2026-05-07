<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Retrieve exchange partner.
 *
 * Maps to the official Dwolla endpoint GET /exchange-partners/{id}.
 */
class DwollaGetExchangePartner extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_get_exchange_partner';
    protected const DESCRIPTION = 'Returns details for a specific open banking provider that integrates with Dwolla. Includes partner name, status, and creation date. Use this to verify partner availability before creating exchanges and funding sources.

Official Dwolla endpoint: GET /exchange-partners/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Exchange Partner resource unique identifier.',
        ],
        'accept' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
            'enum' => ['application/vnd.dwolla.v1.hal+json'],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/exchange-partners/{id}';
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
