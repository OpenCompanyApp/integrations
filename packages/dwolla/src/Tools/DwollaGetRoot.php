<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * root.
 *
 * Maps to the official Dwolla endpoint GET /.
 */
class DwollaGetRoot extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_get_root';
    protected const DESCRIPTION = 'Retrieve the API root entry point to discover available resources and endpoints based on your OAuth access token permissions. Returns HAL+JSON with navigation links to accessible resources including accounts, customers, events, and webhook subscriptions depending on token scope. Essential for API exploration, dynamic resource discovery, and building adaptive client applications that respond to available permissions.

Official Dwolla endpoint: GET /.';
    protected const PARAMETERS = [
        'accept' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
            'enum' => ['application/vnd.dwolla.v1.hal+json'],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'Accept' => 'accept',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
