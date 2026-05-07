<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Adds a flowchart shape item to a board. Required scope boards:write Rate limiting Level 2.
 *
 * Maps to the official Miro endpoint POST /v2-experimental/boards/{board_id}/shapes.
 */
class MiroCreateShapeItemFlowchart extends AbstractMiroTool
{
    protected const NAME = 'miro_create_shape_item_flowchart';
    protected const DESCRIPTION = 'Adds a flowchart shape item to a board. Required scope boards:write Rate limiting Level 2

Official Miro endpoint: POST /v2-experimental/boards/{board_id}/shapes.';
    protected const PARAMETERS = array (
      'board_id' => array (
        'type' => 'string',
        'description' => 'Unique identifier (ID) of the board where you want to create the item.',
        'required' => true,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'Request body matching the Miro API schema.',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/v2-experimental/boards/{board_id}/shapes';
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
