<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Deletes a shape item from the board. Required scope boards:write Rate limiting Level 3.
 *
 * Maps to the official Miro endpoint DELETE /v2/boards/{board_id}/shapes/{item_id}.
 */
class MiroDeleteShapeItem extends AbstractMiroTool
{
    protected const NAME = 'miro_delete_shape_item';
    protected const DESCRIPTION = 'Deletes a shape item from the board. Required scope boards:write Rate limiting Level 3

Official Miro endpoint: DELETE /v2/boards/{board_id}/shapes/{item_id}.';
    protected const PARAMETERS = array (
      'board_id' => array (
        'type' => 'string',
        'description' => 'Unique identifier (ID) of the board from which you want to delete the item.',
        'required' => true,
      ),
      'item_id' => array (
        'type' => 'string',
        'description' => 'Unique identifier (ID) of the item that you want to delete.',
        'required' => true,
      ),
    );
    protected const METHOD = 'DELETE';
    protected const PATH = '/v2/boards/{board_id}/shapes/{item_id}';
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
