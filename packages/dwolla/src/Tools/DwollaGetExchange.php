<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Retrieve exchange resource.
 *
 * Maps to the official Dwolla endpoint GET /exchanges/{id}.
 */
class DwollaGetExchange extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_get_exchange';
    protected const DESCRIPTION = 'Returns details for a specific exchange connection between Dwolla and an open banking partner for a customer\'s bank account. Includes exchange status, creation date, and links to the associated customer and exchange partner.

Official Dwolla endpoint: GET /exchanges/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Exchange resource unique identifier.',
        ],
        'accept' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
            'enum' => ['application/vnd.dwolla.v1.hal+json'],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/exchanges/{id}';
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
