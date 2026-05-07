<?php

namespace OpenCompany\Integrations\StatusCake\Tools;

/**
 * Returns a heartbeat check with the given id..
 *
 * Maps to the official StatusCake endpoint GET /heartbeat/{test_id}.
 */
class StatusCakeGetHeartbeatTest extends AbstractStatusCakeTool
{
    protected const NAME = 'statuscake_get_heartbeat_test';
    protected const DESCRIPTION = 'Returns a heartbeat check with the given id.

Official StatusCake endpoint: GET /heartbeat/{test_id}.';
    protected const PARAMETERS = array (
      'test_id' => array (
        'type' => 'string',
        'description' => 'Heartbeat check ID',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
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
