<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Update a mandate.
 *
 * Maps to the official GoCardless endpoint PUT /mandates/{mandate_id}.
 */
class GoCardlessUpdateMandates extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_update_mandates';
    protected const DESCRIPTION = 'Updates a mandate object. This accepts only the metadata parameter.

Official GoCardless endpoint: PUT /mandates/{mandate_id}.';
    protected const PARAMETERS = [
        'mandate_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The mandate id',
        ],
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
    protected const METHOD = 'PUT';
    protected const PATH = '/mandates/{mandate_id}';
    protected const PATH_PARAMS = [
        'mandate_id' => 'mandate_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
