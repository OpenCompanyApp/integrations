<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Deletes the specified connector from the board. Required scope boards:write Rate limiting Level 3.
 *
 * Maps to the official Miro endpoint DELETE /v2/boards/{board_id}/connectors/{connector_id}.
 */
class MiroDeleteConnector extends AbstractMiroTool
{
    protected const NAME = 'miro_delete_connector';
    protected const DESCRIPTION = 'Deletes the specified connector from the board. Required scope boards:write Rate limiting Level 3

Official Miro endpoint: DELETE /v2/boards/{board_id}/connectors/{connector_id}.';
    protected const PARAMETERS = array (
      'board_id' => array (
        'type' => 'string',
        'description' => 'Unique identifier (ID) of the board from which you want to delete the connector.',
        'required' => true,
      ),
      'connector_id' => array (
        'type' => 'string',
        'description' => 'Unique identifier (ID) of the connector that you want to delete.',
        'required' => true,
      ),
    );
    protected const METHOD = 'DELETE';
    protected const PATH = '/v2/boards/{board_id}/connectors/{connector_id}';
    protected const PATH_PARAMS = array (
      'board_id' => 'board_id',
      'connector_id' => 'connector_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
