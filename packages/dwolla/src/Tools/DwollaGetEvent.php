<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Retrieve event.
 *
 * Maps to the official Dwolla endpoint GET /events/{id}.
 */
class DwollaGetEvent extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_get_event';
    protected const DESCRIPTION = 'Returns detailed information for a specific event representing a state change that occurred on a resource in your Dwolla application. Includes the event topic, timestamp, resource links, and correlation ID if applicable.

Official Dwolla endpoint: GET /events/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'ID of application event to get',
        ],
        'accept' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
            'enum' => ['application/vnd.dwolla.v1.hal+json'],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/events/{id}';
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
