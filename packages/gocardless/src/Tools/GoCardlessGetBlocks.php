<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Get a single block.
 *
 * Maps to the official GoCardless endpoint GET /blocks/{block_id}.
 */
class GoCardlessGetBlocks extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_get_blocks';
    protected const DESCRIPTION = 'Retrieves the details of an existing block.

Official GoCardless endpoint: GET /blocks/{block_id}.';
    protected const PARAMETERS = [
        'block_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The block id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/blocks/{block_id}';
    protected const PATH_PARAMS = [
        'block_id' => 'block_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
