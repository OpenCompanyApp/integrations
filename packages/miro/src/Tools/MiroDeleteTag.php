<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Deletes the specified tag from the board. The tag is also removed from all cards and sticky notes on the board. Note: Updates to tags made via the REST API will not be reflected on the board in realtime. To see REST API updates to tags on a board, you need to refresh the board. This applies to the following endpoints: [Attach tag to item](https://developers.miro.com/reference/attach-tag-to-item), [Remove tag from item](https://developers.miro.com/reference/remove-tag-from-item), [Update tag](https://developers.miro.com/reference/update-tag). Required scope boards:write Rate limiting Level 1.
 *
 * Maps to the official Miro endpoint DELETE /v2/boards/{board_id}/tags/{tag_id}.
 */
class MiroDeleteTag extends AbstractMiroTool
{
    protected const NAME = 'miro_delete_tag';
    protected const DESCRIPTION = 'Deletes the specified tag from the board. The tag is also removed from all cards and sticky notes on the board. Note: Updates to tags made via the REST API will not be reflected on the board in realtime. To see REST API updates to tags on a board, you need to refresh the board. This applies to the following endpoints: [Attach tag to item](https://developers.miro.com/reference/attach-tag-to-item), [Remove tag from item](https://developers.miro.com/reference/remove-tag-from-item), [Update tag](https://developers.miro.com/reference/update-tag). Required scope boards:write Rate limiting Level 1

Official Miro endpoint: DELETE /v2/boards/{board_id}/tags/{tag_id}.';
    protected const PARAMETERS = array (
      'board_id' => array (
        'type' => 'string',
        'description' => 'Unique identifier (ID) of the board where you want to delete a specific tag.',
        'required' => true,
      ),
      'tag_id' => array (
        'type' => 'string',
        'description' => 'Unique identifier (ID) of the tag that you want to delete.',
        'required' => true,
      ),
    );
    protected const METHOD = 'DELETE';
    protected const PATH = '/v2/boards/{board_id}/tags/{tag_id}';
    protected const PATH_PARAMS = array (
      'board_id' => 'board_id',
      'tag_id' => 'tag_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
