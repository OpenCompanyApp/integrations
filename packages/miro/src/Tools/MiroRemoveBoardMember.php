<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Removes a board member from a board. Required scope boards:write Rate limiting Level 2.
 *
 * Maps to the official Miro endpoint DELETE /v2/boards/{board_id}/members/{board_member_id}.
 */
class MiroRemoveBoardMember extends AbstractMiroTool
{
    protected const NAME = 'miro_remove_board_member';
    protected const DESCRIPTION = 'Removes a board member from a board. Required scope boards:write Rate limiting Level 2

Official Miro endpoint: DELETE /v2/boards/{board_id}/members/{board_member_id}.';
    protected const PARAMETERS = array (
      'board_id' => array (
        'type' => 'string',
        'description' => 'Unique identifier (ID) of the board from which you want to delete an item.',
        'required' => true,
      ),
      'board_member_id' => array (
        'type' => 'string',
        'description' => 'Unique identifier (ID) of the board member whose role you want to delete.',
        'required' => true,
      ),
    );
    protected const METHOD = 'DELETE';
    protected const PATH = '/v2/boards/{board_id}/members/{board_member_id}';
    protected const PATH_PARAMS = array (
      'board_id' => 'board_id',
      'board_member_id' => 'board_member_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
