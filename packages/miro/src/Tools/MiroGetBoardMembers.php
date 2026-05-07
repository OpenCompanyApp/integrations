<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Retrieves a pageable list of members for a board. Required scope boards:read Rate limiting Level 1.
 *
 * Maps to the official Miro endpoint GET /v2/boards/{board_id}/members.
 */
class MiroGetBoardMembers extends AbstractMiroTool
{
    protected const NAME = 'miro_get_board_members';
    protected const DESCRIPTION = 'Retrieves a pageable list of members for a board. Required scope boards:read Rate limiting Level 1

Official Miro endpoint: GET /v2/boards/{board_id}/members.';
    protected const PARAMETERS = array (
      'limit' => array (
        'type' => 'string',
        'description' => 'limit parameter.',
        'required' => false,
      ),
      'offset' => array (
        'type' => 'string',
        'description' => 'offset parameter.',
        'required' => false,
      ),
      'board_id' => array (
        'type' => 'string',
        'description' => 'Unique identifier (ID) of the board to which the board member belongs.',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v2/boards/{board_id}/members';
    protected const PATH_PARAMS = array (
      'board_id' => 'board_id',
    );
    protected const QUERY_PARAMS = array (
      'limit' => 'limit',
      'offset' => 'offset',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
