<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Deletes a group from a board. All the items in the group are deleted along with the group. Note - this endpoint will delete items which are locked as well. Required scope boards:write Rate limiting Level 3.
 *
 * Maps to the official Miro endpoint DELETE /v2/boards/{board_id}/groups/{group_id}?.
 */
class MiroDeleteGroup extends AbstractMiroTool
{
    protected const NAME = 'miro_delete_group';
    protected const DESCRIPTION = 'Deletes a group from a board. All the items in the group are deleted along with the group. Note - this endpoint will delete items which are locked as well. Required scope boards:write Rate limiting Level 3

Official Miro endpoint: DELETE /v2/boards/{board_id}/groups/{group_id}?.';
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
        'description' => 'Indicates whether the items should be removed. Set to `true` to delete items in the group.',
        'required' => true,
      ),
    );
    protected const METHOD = 'DELETE';
    protected const PATH = '/v2/boards/{board_id}/groups/{group_id}?';
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
