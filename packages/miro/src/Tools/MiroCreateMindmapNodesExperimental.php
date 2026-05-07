<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Adds a mind map node to a board. A root node is the starting point of a mind map. A node that is created under a root node is a child node. For information on mind maps, use cases, mind map structure, and more, see the Mind Map Overview page. Required scope boards:write Rate limiting Level 2 Known limitations on node placement: Currently, the create API supports explicit positions for nodes. This means that users can only place nodes based on the x, y coordinates provided in the position parameters. If the position is not provided in the request, nodes default to coordinates x=0, y=0, effectively placing them at the center of the board. Upcoming changes: We understand the importance of flexibility in node placement. We are actively working on implementing changes to support positioning nodes relative to their parent node as well. This enhancement offers a more dynamic and intuitive mind mapping experience. Additionally, we are actively working on providing the update API, further enhancing the functionality of mind map APIs..
 *
 * Maps to the official Miro endpoint POST /v2-experimental/boards/{board_id}/mindmap_nodes.
 */
class MiroCreateMindmapNodesExperimental extends AbstractMiroTool
{
    protected const NAME = 'miro_create_mindmap_nodes_experimental';
    protected const DESCRIPTION = 'Adds a mind map node to a board. A root node is the starting point of a mind map. A node that is created under a root node is a child node. For information on mind maps, use cases, mind map structure, and more, see the Mind Map Overview page. Required scope boards:write Rate limiting Level 2 Known limitations on node placement: Currently, the create API supports explicit positions for nodes. This means that users can only place nodes based on the x, y coordinates provided in the position parameters. If the position is not provided in the request, nodes default to coordinates x=0, y=0, effectively placing them at the center of the board. Upcoming changes: We understand the importance of flexibility in node placement. We are actively working on implementing changes to support positioning nodes relative to their parent node as well. This enhancement offers a more dynamic and intuitive mind mapping experience. Additionally, we are actively working on providing the update API, further enhancing the functionality of mind map APIs.

Official Miro endpoint: POST /v2-experimental/boards/{board_id}/mindmap_nodes.';
    protected const PARAMETERS = array (
      'board_id' => array (
        'type' => 'string',
        'description' => 'Unique identifier (ID) of the board where you want to create the item.',
        'required' => true,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'Request body matching the Miro API schema.',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/v2-experimental/boards/{board_id}/mindmap_nodes';
    protected const PATH_PARAMS = array (
      'board_id' => 'board_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
