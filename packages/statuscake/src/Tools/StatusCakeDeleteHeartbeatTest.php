<?php

namespace OpenCompany\Integrations\StatusCake\Tools;

/**
 * Deletes a heartbeat check with the given id..
 *
 * Maps to the official StatusCake endpoint DELETE /heartbeat/{test_id}.
 */
class StatusCakeDeleteHeartbeatTest extends AbstractStatusCakeTool
{
    protected const NAME = 'statuscake_delete_heartbeat_test';
    protected const DESCRIPTION = 'Deletes a heartbeat check with the given id.

Official StatusCake endpoint: DELETE /heartbeat/{test_id}.';
    protected const PARAMETERS = array (
      'test_id' => array (
        'type' => 'string',
        'description' => 'Heartbeat check ID',
        'required' => true,
      ),
    );
    protected const METHOD = 'DELETE';
    protected const PATH = '/heartbeat/{test_id}';
    protected const PATH_PARAMS = array (
      'test_id' => 'test_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
