<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Retrieve a label.
 *
 * Maps to the official Dwolla endpoint GET /labels/{id}.
 */
class DwollaGetLabel extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_get_label';
    protected const DESCRIPTION = 'Retrieve details for a specific Label used to categorize and track funds within your account. Returns Label information including unique identifier, current amount with currency, and creation timestamp.

Official Dwolla endpoint: GET /labels/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Label unique identifier',
        ],
        'accept' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
            'enum' => ['application/vnd.dwolla.v1.hal+json'],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/labels/{id}';
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
