<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Updates the position or the parent of an item on a board. Required scope boards:write Rate limiting Level 2.
 *
 * Maps to the official Miro endpoint PATCH /v2/boards/{board_id}/items/{item_id}.
 */
class MiroUpdateItemPositionOrParent extends AbstractMiroTool
{
    protected const NAME = 'miro_update_item_position_or_parent';
    protected const DESCRIPTION = 'Updates the position or the parent of an item on a board. Required scope boards:write Rate limiting Level 2

Official Miro endpoint: PATCH /v2/boards/{board_id}/items/{item_id}.';
    protected const PARAMETERS = array (
      'board_id' => array (
        'type' => 'string',
        'description' => 'Unique identifier (ID) of the board where you want to update the item.',
        'required' => true,
      ),
      'item_id' => array (
        'type' => 'string',
        'description' => 'Unique identifier (ID) of the item that you want to update.',
        'required' => true,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'Request body matching the Miro API schema.',
        'required' => true,
      ),
    );
    protected const METHOD = 'PATCH';
    protected const PATH = '/v2/boards/{board_id}/items/{item_id}';
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
