<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Retrieves a list of code widget items for a specific board. This method returns results using a cursor-based approach. A cursor-paginated method returns a portion of the total set of results based on the limit specified and a cursor that points to the next portion of the results. To retrieve the next portion of the collection, on your next call to the same method, set the `cursor` parameter equal to the `cursor` value you received in the response of the previous request. Required scope boards:read Rate limiting Level 2.
 *
 * Maps to the official Miro endpoint GET /v2-experimental/boards/{board_id}/code_widgets.
 */
class MiroGetCodeWidgetItems extends AbstractMiroTool
{
    protected const NAME = 'miro_get_code_widget_items';
    protected const DESCRIPTION = 'Retrieves a list of code widget items for a specific board. This method returns results using a cursor-based approach. A cursor-paginated method returns a portion of the total set of results based on the limit specified and a cursor that points to the next portion of the results. To retrieve the next portion of the collection, on your next call to the same method, set the `cursor` parameter equal to the `cursor` value you received in the response of the previous request. Required scope boards:read Rate limiting Level 2

Official Miro endpoint: GET /v2-experimental/boards/{board_id}/code_widgets.';
    protected const PARAMETERS = array (
      'limit' => array (
        'type' => 'string',
        'description' => 'limit parameter.',
        'required' => false,
      ),
      'cursor' => array (
        'type' => 'string',
        'description' => 'cursor parameter.',
        'required' => false,
      ),
      'board_id' => array (
        'type' => 'string',
        'description' => 'Unique identifier (ID) of the board for which you want to retrieve the list of code widget items.',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v2-experimental/boards/{board_id}/code_widgets';
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
