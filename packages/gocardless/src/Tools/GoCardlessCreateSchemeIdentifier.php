<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Create a scheme identifier.
 *
 * Maps to the official GoCardless endpoint POST /scheme_identifiers.
 */
class GoCardlessCreateSchemeIdentifier extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_create_scheme_identifier';
    protected const DESCRIPTION = 'Create a scheme identifier

Official GoCardless endpoint: POST /scheme_identifiers.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official GoCardless OpenAPI schema.',
        ],
        'idempotency_key' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/scheme_identifiers';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
