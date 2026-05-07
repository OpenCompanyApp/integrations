<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Deletes an app card item from a board. Required scope boards:write Rate limiting Level 3.
 *
 * Maps to the official Miro endpoint DELETE /v2/boards/{board_id}/app_cards/{item_id}.
 */
class MiroDeleteAppCardItem extends AbstractMiroTool
{
    protected const NAME = 'miro_delete_app_card_item';
    protected const DESCRIPTION = 'Deletes an app card item from a board. Required scope boards:write Rate limiting Level 3

Official Miro endpoint: DELETE /v2/boards/{board_id}/app_cards/{item_id}.';
    protected const PARAMETERS = array (
      'board_id' => array (
        'type' => 'string',
        'description' => 'Unique identifier (ID) of the board from which you want to delete an item.',
        'required' => true,
      ),
      'item_id' => array (
        'type' => 'string',
        'description' => 'Unique identifier (ID) of the item that you want to delete.',
        'required' => true,
      ),
    );
    protected const METHOD = 'DELETE';
    protected const PATH = '/v2/boards/{board_id}/app_cards/{item_id}';
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
