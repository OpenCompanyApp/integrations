<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Retrieves a list of mind map nodes for a specific board. This method returns results using a cursor-based approach. A cursor-paginated method returns a portion of the total set of results based on the limit specified and a cursor that points to the next portion of the results. To retrieve the next portion of the collection, on your next call to the same method, set the `cursor` parameter equal to the `cursor` value you received in the response of the previous request. For example, if you set the `limit` query parameter to `10` and the board contains 20 objects, the first call will return information about the first 10 objects in the response along with a cursor parameter and value. In this example, let's say the cursor parameter value returned in the response is `foo`. If you want to retrieve the next set of objects, on your next call to the same method, set the cursor parameter value to `foo`. Required scope boards:read Rate limiting Level 2.
 *
 * Maps to the official Miro endpoint GET /v2-experimental/boards/{board_id}/mindmap_nodes.
 */
class MiroGetMindmapNodesExperimental extends AbstractMiroTool
{
    protected const NAME = 'miro_get_mindmap_nodes_experimental';
    protected const DESCRIPTION = 'Retrieves a list of mind map nodes for a specific board. This method returns results using a cursor-based approach. A cursor-paginated method returns a portion of the total set of results based on the limit specified and a cursor that points to the next portion of the results. To retrieve the next portion of the collection, on your next call to the same method, set the `cursor` parameter equal to the `cursor` value you received in the response of the previous request. For example, if you set the `limit` query parameter to `10` and the board contains 20 objects, the first call will return information about the first 10 objects in the response along with a cursor parameter and value. In this example, let\'s say the cursor parameter value returned in the response is `foo`. If you want to retrieve the next set of objects, on your next call to the same method, set the cursor parameter value to `foo`. Required scope boards:read Rate limiting Level 2

Official Miro endpoint: GET /v2-experimental/boards/{board_id}/mindmap_nodes.';
    protected const PARAMETERS = array (
      'board_id' => array (
        'type' => 'string',
        'description' => 'board_id path parameter.',
        'required' => true,
      ),
      'limit' => array (
        'type' => 'string',
        'description' => 'Maximum number of results returned',
        'required' => false,
      ),
      'cursor' => array (
        'type' => 'string',
        'description' => 'Points to the next portion of the results set',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v2-experimental/boards/{board_id}/mindmap_nodes';
    protected const PATH_PARAMS = array (
      'board_id' => 'board_id',
    );
    protected const QUERY_PARAMS = array (
      'limit' => 'limit',
      'cursor' => 'cursor',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
