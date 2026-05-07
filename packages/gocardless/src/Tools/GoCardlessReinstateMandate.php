<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Reinstate a mandate.
 *
 * Maps to the official GoCardless endpoint POST /mandates/{mandate_id}/actions/reinstate.
 */
class GoCardlessReinstateMandate extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_reinstate_mandate';
    protected const DESCRIPTION = 'Reinstate a mandate

Official GoCardless endpoint: POST /mandates/{mandate_id}/actions/reinstate.';
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
    protected const METHOD = 'POST';
    protected const PATH = '/mandates/{mandate_id}/actions/reinstate';
    protected const PATH_PARAMS = [
        'mandate_id' => 'mandate_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
