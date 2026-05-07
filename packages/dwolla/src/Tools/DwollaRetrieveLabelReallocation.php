<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Retrieve a label reallocation.
 *
 * Maps to the official Dwolla endpoint GET /label-reallocations/{reallocationId}.
 */
class DwollaRetrieveLabelReallocation extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_retrieve_label_reallocation';
    protected const DESCRIPTION = 'Retrieve details for a specific label reallocation that transfers funds between Labels. Returns reallocation information including source and destination Labels, amount transferred, status, and creation timestamp. Use this to track and audit fund movements between different Labels.

Official Dwolla endpoint: GET /label-reallocations/{reallocationId}.';
    protected const PARAMETERS = [
        'reallocation_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Label reallocation unique identifier',
        ],
        'accept' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
            'enum' => ['application/vnd.dwolla.v1.hal+json'],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/label-reallocations/{reallocationId}';
    protected const PATH_PARAMS = [
        'reallocationId' => 'reallocation_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'Accept' => 'accept',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
