<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * This endpoint updates an existing group by replacing it entirely with a new group. When the update is made, the original group is completely replaced, and a new group ID is assigned. Required scope boards:write Rate limiting Level 2.
 *
 * Maps to the official Miro endpoint PUT /v2/boards/{board_id}/groups/{group_id}.
 */
class MiroUpdateGroup extends AbstractMiroTool
{
    protected const NAME = 'miro_update_group';
    protected const DESCRIPTION = 'This endpoint updates an existing group by replacing it entirely with a new group. When the update is made, the original group is completely replaced, and a new group ID is assigned. Required scope boards:write Rate limiting Level 2

Official Miro endpoint: PUT /v2/boards/{board_id}/groups/{group_id}.';
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
      'body' => array (
        'type' => 'object',
        'description' => 'Request body matching the Miro API schema.',
        'required' => true,
      ),
    );
    protected const METHOD = 'PUT';
    protected const PATH = '/v2/boards/{board_id}/groups/{group_id}';
    protected const PATH_PARAMS = array (
      'board_id' => 'board_id',
      'group_id' => 'group_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
