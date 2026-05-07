<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Ungroups items from a group. Required scope boards:write Rate limiting Level 3.
 *
 * Maps to the official Miro endpoint DELETE /v2/boards/{board_id}/groups/{group_id}.
 */
class MiroUnGroup extends AbstractMiroTool
{
    protected const NAME = 'miro_un_group';
    protected const DESCRIPTION = 'Ungroups items from a group. Required scope boards:write Rate limiting Level 3

Official Miro endpoint: DELETE /v2/boards/{board_id}/groups/{group_id}.';
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
      'delete_items' => array (
        'type' => 'boolean',
        'description' => 'Indicates whether the items should be removed. By default, false.',
        'required' => false,
      ),
    );
    protected const METHOD = 'DELETE';
    protected const PATH = '/v2/boards/{board_id}/groups/{group_id}';
    protected const PATH_PARAMS = array (
      'board_id' => 'board_id',
      'group_id' => 'group_id',
    );
    protected const QUERY_PARAMS = array (
      'delete_items' => 'delete_items',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
