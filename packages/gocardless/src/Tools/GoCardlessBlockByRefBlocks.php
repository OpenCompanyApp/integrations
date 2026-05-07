<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Create blocks by reference.
 *
 * Maps to the official GoCardless endpoint POST /blocks/block_by_ref.
 */
class GoCardlessBlockByRefBlocks extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_block_by_ref_blocks';
    protected const DESCRIPTION = 'Creates new blocks for a given reference. By default blocks will be active. Returns 201 if at least one block was created. Returns 200 if there were no new blocks created.

Official GoCardless endpoint: POST /blocks/block_by_ref.';
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
    protected const PATH = '/blocks/block_by_ref';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
