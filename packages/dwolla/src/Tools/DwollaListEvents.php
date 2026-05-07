<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * List events.
 *
 * Maps to the official Dwolla endpoint GET /events.
 */
class DwollaListEvents extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_list_events';
    protected const DESCRIPTION = 'Returns a paginated list of events representing state changes to resources in your Dwolla application. Events track actions on customers, transfers, funding sources, and other resources, sorted by creation date (newest first). Events are retained for 30 days and are essential for webhook notifications and system activity monitoring.

Official Dwolla endpoint: GET /events.';
    protected const PARAMETERS = [
        'limit' => [
            'type' => 'number',
            'required' => false,
            'description' => 'How many results to return',
        ],
        'offset' => [
            'type' => 'number',
            'required' => false,
            'description' => 'How many results to skip',
        ],
        'accept' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
            'enum' => ['application/vnd.dwolla.v1.hal+json'],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/events';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'limit' => 'limit',
        'offset' => 'offset',
    ];
    protected const HEADER_PARAMS = [
        'Accept' => 'accept',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
