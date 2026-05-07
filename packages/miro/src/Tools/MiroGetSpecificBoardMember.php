<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Retrieves information for a board member. Required scope boards:read Rate limiting Level 1.
 *
 * Maps to the official Miro endpoint GET /v2/boards/{board_id}/members/{board_member_id}.
 */
class MiroGetSpecificBoardMember extends AbstractMiroTool
{
    protected const NAME = 'miro_get_specific_board_member';
    protected const DESCRIPTION = 'Retrieves information for a board member. Required scope boards:read Rate limiting Level 1

Official Miro endpoint: GET /v2/boards/{board_id}/members/{board_member_id}.';
    protected const PARAMETERS = array (
      'board_id' => array (
        'type' => 'string',
        'description' => 'Unique identifier (ID) of the board to which the board member belongs.',
        'required' => true,
      ),
      'board_member_id' => array (
        'type' => 'string',
        'description' => 'Unique identifier (ID) of the board member whose role you want to retrieve.',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
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
