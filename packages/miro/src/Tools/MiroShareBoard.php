<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Shares the board and Invites new members to collaborate on a board by sending an invitation email. Depending on the board's Sharing policy, there might be various scenarios where membership in the team is required in order to share the board with a user. Required scope boards:write Rate limiting Level 3.
 *
 * Maps to the official Miro endpoint POST /v2/boards/{board_id}/members.
 */
class MiroShareBoard extends AbstractMiroTool
{
    protected const NAME = 'miro_share_board';
    protected const DESCRIPTION = 'Shares the board and Invites new members to collaborate on a board by sending an invitation email. Depending on the board\'s Sharing policy, there might be various scenarios where membership in the team is required in order to share the board with a user. Required scope boards:write Rate limiting Level 3

Official Miro endpoint: POST /v2/boards/{board_id}/members.';
    protected const PARAMETERS = array (
      'board_id' => array (
        'type' => 'string',
        'description' => 'Unique identifier (ID) of the board to which the board member belongs.',
        'required' => true,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'Request body matching the Miro API schema.',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/v2/boards/{board_id}/members';
    protected const PATH_PARAMS = array (
      'board_id' => 'board_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
