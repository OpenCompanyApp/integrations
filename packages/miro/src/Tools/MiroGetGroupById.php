<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Returns a list of items in a specific group. Required scope boards:read Rate limiting Level 2 per item ID.
 *
 * Maps to the official Miro endpoint GET /v2/boards/{board_id}/groups/{group_id}.
 */
class MiroGetGroupById extends AbstractMiroTool
{
    protected const NAME = 'miro_get_group_by_id';
    protected const DESCRIPTION = 'Returns a list of items in a specific group. Required scope boards:read Rate limiting Level 2 per item ID

Official Miro endpoint: GET /v2/boards/{board_id}/groups/{group_id}.';
    protected const PARAMETERS = array (
      'board_id' => array (
        'type' => 'string',
        'description' => 'Unique identifier (ID) of the board.',
        'required' => true,
      ),
      'group_id' => array (
        'type' => 'string',
        'description' => 'Unique identifier (ID) of the group.',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v2/boards/{board_id}/groups/{group_id}';
    protected const PATH_PARAMS = array (
      'board_id' => 'board_id',
      'group_id' => 'group_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
