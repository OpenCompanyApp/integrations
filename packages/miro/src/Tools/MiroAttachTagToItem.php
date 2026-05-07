<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Attach an existing tag to the specified item. Card and sticky note items can have up to 8 tags. Note: Updates to tags made via the REST API will not be reflected on the board in realtime. To see REST API updates to tags on a board, you need to refresh the board. This applies to the following endpoints: [Remove tag from item](https://developers.miro.com/reference/remove-tag-from-item), [Update tag](https://developers.miro.com/reference/update-tag), [Delete tag](https://developers.miro.com/reference/delete-tag). Required scope boards:write Rate limiting Level 1.
 *
 * Maps to the official Miro endpoint POST /v2/boards/{board_id_PlatformTags}/items/{item_id}.
 */
class MiroAttachTagToItem extends AbstractMiroTool
{
    protected const NAME = 'miro_attach_tag_to_item';
    protected const DESCRIPTION = 'Attach an existing tag to the specified item. Card and sticky note items can have up to 8 tags. Note: Updates to tags made via the REST API will not be reflected on the board in realtime. To see REST API updates to tags on a board, you need to refresh the board. This applies to the following endpoints: [Remove tag from item](https://developers.miro.com/reference/remove-tag-from-item), [Update tag](https://developers.miro.com/reference/update-tag), [Delete tag](https://developers.miro.com/reference/delete-tag). Required scope boards:write Rate limiting Level 1

Official Miro endpoint: POST /v2/boards/{board_id_PlatformTags}/items/{item_id}.';
    protected const PARAMETERS = array (
      'board_id_platform_tags' => array (
        'type' => 'string',
        'description' => 'Unique identifier (ID) of the board with the item that you want to add a tag to.',
        'required' => true,
      ),
      'item_id' => array (
        'type' => 'string',
        'description' => 'Unique identifier (ID) of the item to which you want to add a tag.',
        'required' => true,
      ),
      'tag_id' => array (
        'type' => 'string',
        'description' => 'Unique identifier (ID) of the tag you want to add to the item.',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/v2/boards/{board_id_PlatformTags}/items/{item_id}';
    protected const PATH_PARAMS = array (
      'board_id_PlatformTags' => 'board_id_platform_tags',
      'item_id' => 'item_id',
    );
    protected const QUERY_PARAMS = array (
      'tag_id' => 'tag_id',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
