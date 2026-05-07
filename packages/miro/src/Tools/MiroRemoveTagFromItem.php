<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Removes the specified tag from the specified item. The tag still exists on the board. Note: Updates to tags made via the REST API will not be reflected on the board in realtime. To see REST API updates to tags on a board, you need to refresh the board. This applies to the following endpoints: [Attach tag to item](https://developers.miro.com/reference/attach-tag-to-item), [Update tag](https://developers.miro.com/reference/update-tag), [Delete tag](https://developers.miro.com/reference/delete-tag). Required scope boards:write Rate limiting Level 1.
 *
 * Maps to the official Miro endpoint DELETE /v2/boards/{board_id_PlatformTags}/items/{item_id}.
 */
class MiroRemoveTagFromItem extends AbstractMiroTool
{
    protected const NAME = 'miro_remove_tag_from_item';
    protected const DESCRIPTION = 'Removes the specified tag from the specified item. The tag still exists on the board. Note: Updates to tags made via the REST API will not be reflected on the board in realtime. To see REST API updates to tags on a board, you need to refresh the board. This applies to the following endpoints: [Attach tag to item](https://developers.miro.com/reference/attach-tag-to-item), [Update tag](https://developers.miro.com/reference/update-tag), [Delete tag](https://developers.miro.com/reference/delete-tag). Required scope boards:write Rate limiting Level 1

Official Miro endpoint: DELETE /v2/boards/{board_id_PlatformTags}/items/{item_id}.';
    protected const PARAMETERS = array (
      'board_id_platform_tags' => array (
        'type' => 'string',
        'description' => 'Unique identifier (ID) of the board with the item that you want to remove a tag from.',
        'required' => true,
      ),
      'item_id' => array (
        'type' => 'string',
        'description' => 'Unique identifier (ID) of the item that you want to remove the tag from.',
        'required' => true,
      ),
      'tag_id' => array (
        'type' => 'string',
        'description' => 'Unique identifier (ID) of the tag that you want to remove from the item.',
        'required' => true,
      ),
    );
    protected const METHOD = 'DELETE';
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
