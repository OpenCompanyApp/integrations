<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Deletes a board. Deleted boards go to Trash (on paid plans) and can be restored via UI within 90 days after deletion. Required scope boards:write Rate limiting Level 3.
 *
 * Maps to the official Miro endpoint DELETE /v2/boards/{board_id}.
 */
class MiroDeleteBoard extends AbstractMiroTool
{
    protected const NAME = 'miro_delete_board';
    protected const DESCRIPTION = 'Deletes a board. Deleted boards go to Trash (on paid plans) and can be restored via UI within 90 days after deletion. Required scope boards:write Rate limiting Level 3

Official Miro endpoint: DELETE /v2/boards/{board_id}.';
    protected const PARAMETERS = array (
      'board_id' => array (
        'type' => 'string',
        'description' => 'Unique identifier (ID) of the board that you want to delete.',
        'required' => true,
      ),
    );
    protected const METHOD = 'DELETE';
    protected const PATH = '/v2/boards/{board_id}';
    protected const PATH_PARAMS = array (
      'board_id' => 'board_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
