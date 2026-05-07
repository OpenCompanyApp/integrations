<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Disable a block.
 *
 * Maps to the official GoCardless endpoint POST /blocks/{block_id}/actions/disable.
 */
class GoCardlessDisableBlock extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_disable_block';
    protected const DESCRIPTION = 'Disables a block so that it no longer will prevent mandate creation.

Official GoCardless endpoint: POST /blocks/{block_id}/actions/disable.';
    protected const PARAMETERS = [
        'block_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The block id',
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
    protected const PATH = '/blocks/{block_id}/actions/disable';
    protected const PATH_PARAMS = [
        'block_id' => 'block_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
