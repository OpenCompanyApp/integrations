<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Deletes a mind map node item and its child nodes from the board. Required scope boards:write Rate limiting Level 3.
 *
 * Maps to the official Miro endpoint DELETE /v2-experimental/boards/{board_id}/mindmap_nodes/{item_id}.
 */
class MiroDeleteMindmapNodeExperimental extends AbstractMiroTool
{
    protected const NAME = 'miro_delete_mindmap_node_experimental';
    protected const DESCRIPTION = 'Deletes a mind map node item and its child nodes from the board. Required scope boards:write Rate limiting Level 3

Official Miro endpoint: DELETE /v2-experimental/boards/{board_id}/mindmap_nodes/{item_id}.';
    protected const PARAMETERS = array (
      'board_id' => array (
        'type' => 'string',
        'description' => 'Unique identifier (ID) of the board from which you want to delete the mind map node.',
        'required' => true,
      ),
      'item_id' => array (
        'type' => 'string',
        'description' => 'Unique identifier (ID) of the mind map node that you want to delete.',
        'required' => true,
      ),
    );
    protected const METHOD = 'DELETE';
    protected const PATH = '/v2-experimental/boards/{board_id}/mindmap_nodes/{item_id}';
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
