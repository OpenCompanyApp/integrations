<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Updates a tag based on the data properties provided in the request body. Note: Updates to tags made via the REST API will not be reflected on the board in realtime. To see REST API updates to tags on a board, you need to refresh the board. This applies to the following endpoints: [Attach tag to item](https://developers.miro.com/reference/attach-tag-to-item), [Remove tag from item](https://developers.miro.com/reference/remove-tag-from-item), [Delete tag](https://developers.miro.com/reference/delete-tag). Required scope boards:write Rate limiting Level 1.
 *
 * Maps to the official Miro endpoint PATCH /v2/boards/{board_id}/tags/{tag_id}.
 */
class MiroUpdateTag extends AbstractMiroTool
{
    protected const NAME = 'miro_update_tag';
    protected const DESCRIPTION = 'Updates a tag based on the data properties provided in the request body. Note: Updates to tags made via the REST API will not be reflected on the board in realtime. To see REST API updates to tags on a board, you need to refresh the board. This applies to the following endpoints: [Attach tag to item](https://developers.miro.com/reference/attach-tag-to-item), [Remove tag from item](https://developers.miro.com/reference/remove-tag-from-item), [Delete tag](https://developers.miro.com/reference/delete-tag). Required scope boards:write Rate limiting Level 1

Official Miro endpoint: PATCH /v2/boards/{board_id}/tags/{tag_id}.';
    protected const PARAMETERS = array (
      'board_id' => array (
        'type' => 'string',
        'description' => 'Unique identifier (ID) of the board where you want to update a specific tag.',
        'required' => true,
      ),
      'tag_id' => array (
        'type' => 'string',
        'description' => 'Unique identifier (ID) of the tag that you want to update.',
        'required' => true,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'Request body matching the Miro API schema.',
        'required' => true,
      ),
    );
    protected const METHOD = 'PATCH';
    protected const PATH = '/v2/boards/{board_id}/tags/{tag_id}';
    protected const PATH_PARAMS = array (
      'board_id' => 'board_id',
      'tag_id' => 'tag_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
