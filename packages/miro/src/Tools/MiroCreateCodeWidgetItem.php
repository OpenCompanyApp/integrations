<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Adds a code widget item to a board. Required scope boards:write Rate limiting Level 2.
 *
 * Maps to the official Miro endpoint POST /v2-experimental/boards/{board_id}/code_widgets.
 */
class MiroCreateCodeWidgetItem extends AbstractMiroTool
{
    protected const NAME = 'miro_create_code_widget_item';
    protected const DESCRIPTION = 'Adds a code widget item to a board. Required scope boards:write Rate limiting Level 2

Official Miro endpoint: POST /v2-experimental/boards/{board_id}/code_widgets.';
    protected const PARAMETERS = array (
      'board_id' => array (
        'type' => 'string',
        'description' => 'Unique identifier (ID) of the board where you want to create the item.',
        'required' => true,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'Request body matching the Miro API schema.',
        'required' => false,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/v2-experimental/boards/{board_id}/code_widgets';
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
