<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Updates the role of a board member. Required scope boards:write Rate limiting Level 2.
 *
 * Maps to the official Miro endpoint PATCH /v2/boards/{board_id}/members/{board_member_id}.
 */
class MiroUpdateBoardMember extends AbstractMiroTool
{
    protected const NAME = 'miro_update_board_member';
    protected const DESCRIPTION = 'Updates the role of a board member. Required scope boards:write Rate limiting Level 2

Official Miro endpoint: PATCH /v2/boards/{board_id}/members/{board_member_id}.';
    protected const PARAMETERS = array (
      'board_id' => array (
        'type' => 'string',
        'description' => 'Unique identifier (ID) of the board for which you want to update the role of the board member.',
        'required' => true,
      ),
      'board_member_id' => array (
        'type' => 'string',
        'description' => 'Unique identifier (ID) of the board member whose role you want to update.',
        'required' => true,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'Request body matching the Miro API schema.',
        'required' => true,
      ),
    );
    protected const METHOD = 'PATCH';
    protected const PATH = '/v2/boards/{board_id}/members/{board_member_id}';
    protected const PATH_PARAMS = array (
      'board_id' => 'board_id',
      'board_member_id' => 'board_member_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
