<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Retrieves all the tags from the specified item. Required scope boards:read Rate limiting Level 1.
 *
 * Maps to the official Miro endpoint GET /v2/boards/{board_id}/items/{item_id}/tags.
 */
class MiroGetTagsFromItem extends AbstractMiroTool
{
    protected const NAME = 'miro_get_tags_from_item';
    protected const DESCRIPTION = 'Retrieves all the tags from the specified item. Required scope boards:read Rate limiting Level 1

Official Miro endpoint: GET /v2/boards/{board_id}/items/{item_id}/tags.';
    protected const PARAMETERS = array (
      'board_id' => array (
        'type' => 'string',
        'description' => 'Unique identifier (ID) of the board with the item whose tags you want to retrieve.',
        'required' => true,
      ),
      'item_id' => array (
        'type' => 'string',
        'description' => 'Unique identifier (ID) of the item whose tags you want to retrieve.',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v2/boards/{board_id}/items/{item_id}/tags';
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
