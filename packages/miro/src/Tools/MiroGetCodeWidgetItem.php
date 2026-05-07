<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Retrieves information for a specific code widget item on a board. Required scope boards:read Rate limiting Level 1.
 *
 * Maps to the official Miro endpoint GET /v2-experimental/boards/{board_id}/code_widgets/{item_id}.
 */
class MiroGetCodeWidgetItem extends AbstractMiroTool
{
    protected const NAME = 'miro_get_code_widget_item';
    protected const DESCRIPTION = 'Retrieves information for a specific code widget item on a board. Required scope boards:read Rate limiting Level 1

Official Miro endpoint: GET /v2-experimental/boards/{board_id}/code_widgets/{item_id}.';
    protected const PARAMETERS = array (
      'board_id' => array (
        'type' => 'string',
        'description' => 'Unique identifier (ID) of the board from which you want to retrieve a specific item.',
        'required' => true,
      ),
      'item_id' => array (
        'type' => 'string',
        'description' => 'Unique identifier (ID) of the item that you want to retrieve.',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v2-experimental/boards/{board_id}/code_widgets/{item_id}';
    protected const PATH_PARAMS = array (
      'board_id' => 'board_id',
      'item_id' => 'item_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
