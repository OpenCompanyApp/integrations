<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Create a label reallocation.
 *
 * Maps to the official Dwolla endpoint POST /label-reallocations.
 */
class DwollaCreateLabelReallocation extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_create_label_reallocation';
    protected const DESCRIPTION = 'Reallocates funds between two labels belonging to the same Verified Customer. Moves the specified amount from the source label to the destination label, creating ledger entries for both. The reallocation only succeeds if the source label has sufficient funds.

Official Dwolla endpoint: POST /label-reallocations.';
    protected const PARAMETERS = [
        'accept' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
            'enum' => ['application/vnd.dwolla.v1.hal+json'],
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Dwolla OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/label-reallocations';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'Accept' => 'accept',
    ];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
