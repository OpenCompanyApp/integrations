<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Updates a frame on a board based on the data, style, or geometry properties provided in the request body. Required scope boards:write Rate limiting Level 2.
 *
 * Maps to the official Miro endpoint PATCH /v2/boards/{board_id}/frames/{item_id}.
 */
class MiroUpdateFrameItem extends AbstractMiroTool
{
    protected const NAME = 'miro_update_frame_item';
    protected const DESCRIPTION = 'Updates a frame on a board based on the data, style, or geometry properties provided in the request body. Required scope boards:write Rate limiting Level 2

Official Miro endpoint: PATCH /v2/boards/{board_id}/frames/{item_id}.';
    protected const PARAMETERS = array (
      'board_id' => array (
        'type' => 'string',
        'description' => 'Unique identifier (ID) of the board where you want to update the frame.',
        'required' => true,
      ),
      'item_id' => array (
        'type' => 'string',
        'description' => 'Unique identifier (ID) of the frame that you want to update.',
        'required' => true,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'Request body matching the Miro API schema.',
        'required' => true,
      ),
    );
    protected const METHOD = 'PATCH';
    protected const PATH = '/v2/boards/{board_id}/frames/{item_id}';
    protected const PATH_PARAMS = array (
      'board_id' => 'board_id',
      'item_id' => 'item_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
