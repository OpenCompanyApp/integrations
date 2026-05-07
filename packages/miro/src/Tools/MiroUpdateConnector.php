<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Updates a connector on a board based on the data and style properties provided in the request body. Required scope boards:write Rate limiting Level 2.
 *
 * Maps to the official Miro endpoint PATCH /v2/boards/{board_id}/connectors/{connector_id}.
 */
class MiroUpdateConnector extends AbstractMiroTool
{
    protected const NAME = 'miro_update_connector';
    protected const DESCRIPTION = 'Updates a connector on a board based on the data and style properties provided in the request body. Required scope boards:write Rate limiting Level 2

Official Miro endpoint: PATCH /v2/boards/{board_id}/connectors/{connector_id}.';
    protected const PARAMETERS = array (
      'board_id' => array (
        'type' => 'string',
        'description' => 'Unique identifier (ID) of the board for which you want to update the connector.',
        'required' => true,
      ),
      'connector_id' => array (
        'type' => 'string',
        'description' => 'Unique identifier (ID) of the connector that you want to update.',
        'required' => true,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'Request body matching the Miro API schema.',
        'required' => true,
      ),
    );
    protected const METHOD = 'PATCH';
    protected const PATH = '/v2/boards/{board_id}/connectors/{connector_id}';
    protected const PATH_PARAMS = array (
      'board_id' => 'board_id',
      'connector_id' => 'connector_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
