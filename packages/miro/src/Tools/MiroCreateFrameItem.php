<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Adds a frame to a board. Required scope boards:write Rate limiting Level 2.
 *
 * Maps to the official Miro endpoint POST /v2/boards/{board_id}/frames.
 */
class MiroCreateFrameItem extends AbstractMiroTool
{
    protected const NAME = 'miro_create_frame_item';
    protected const DESCRIPTION = 'Adds a frame to a board. Required scope boards:write Rate limiting Level 2

Official Miro endpoint: POST /v2/boards/{board_id}/frames.';
    protected const PARAMETERS = array (
      'board_id' => array (
        'type' => 'string',
        'description' => 'Unique identifier (ID) of the board where you want to create a frame.',
        'required' => true,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'Request body matching the Miro API schema.',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/v2/boards/{board_id}/frames';
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
