<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Retrieves all the items that have the specified tag. Required scope boards:read Rate limiting Level 1.
 *
 * Maps to the official Miro endpoint GET /v2/boards/{board_id_PlatformTags}/items.
 */
class MiroGetItemsByTag extends AbstractMiroTool
{
    protected const NAME = 'miro_get_items_by_tag';
    protected const DESCRIPTION = 'Retrieves all the items that have the specified tag. Required scope boards:read Rate limiting Level 1

Official Miro endpoint: GET /v2/boards/{board_id_PlatformTags}/items.';
    protected const PARAMETERS = array (
      'limit' => array (
        'type' => 'string',
        'description' => 'limit parameter.',
        'required' => false,
      ),
      'offset' => array (
        'type' => 'string',
        'description' => 'offset parameter.',
        'required' => false,
      ),
      'board_id_platform_tags' => array (
        'type' => 'string',
        'description' => 'Unique identifier (ID) of the board where you want to retrieve a specific tag.',
        'required' => true,
      ),
      'tag_id' => array (
        'type' => 'string',
        'description' => 'Unique identifier (ID) of the tag that you want to retrieve.',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v2/boards/{board_id_PlatformTags}/items';
    protected const PATH_PARAMS = array (
      'board_id_PlatformTags' => 'board_id_platform_tags',
    );
    protected const QUERY_PARAMS = array (
      'limit' => 'limit',
      'offset' => 'offset',
      'tag_id' => 'tag_id',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
