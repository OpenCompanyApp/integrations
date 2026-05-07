<?php

namespace OpenCompany\Integrations\StatusCake\Tools;

/**
 * Updates a heartbeat check with the given parameters..
 *
 * Maps to the official StatusCake endpoint PUT /heartbeat/{test_id}.
 */
class StatusCakeUpdateHeartbeatTest extends AbstractStatusCakeTool
{
    protected const NAME = 'statuscake_update_heartbeat_test';
    protected const DESCRIPTION = 'Updates a heartbeat check with the given parameters.

Official StatusCake endpoint: PUT /heartbeat/{test_id}.';
    protected const PARAMETERS = array (
      'test_id' => array (
        'type' => 'string',
        'description' => 'Heartbeat check ID',
        'required' => true,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'Form fields matching the StatusCake API schema.',
        'required' => true,
      ),
    );
    protected const METHOD = 'PUT';
    protected const PATH = '/heartbeat/{test_id}';
    protected const PATH_PARAMS = array (
      'test_id' => 'test_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
