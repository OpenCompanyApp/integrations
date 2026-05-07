<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Get a single scheme identifier.
 *
 * Maps to the official GoCardless endpoint GET /scheme_identifiers/{scheme_identifier_id}.
 */
class GoCardlessGetSchemeIdentifiers extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_get_scheme_identifiers';
    protected const DESCRIPTION = 'Retrieves the details of an existing scheme identifier.

Official GoCardless endpoint: GET /scheme_identifiers/{scheme_identifier_id}.';
    protected const PARAMETERS = [
        'scheme_identifier_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The scheme identifier id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/scheme_identifiers/{scheme_identifier_id}';
    protected const PATH_PARAMS = [
        'scheme_identifier_id' => 'scheme_identifier_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
