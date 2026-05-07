<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Create a block.
 *
 * Maps to the official GoCardless endpoint POST /blocks.
 */
class GoCardlessCreateBlock extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_create_block';
    protected const DESCRIPTION = 'Creates a new Block of a given type. By default it will be active.

Official GoCardless endpoint: POST /blocks.';
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
    protected const PATH = '/blocks';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
