<?php

namespace OpenCompany\Integrations\StatusCake\Tools;

/**
 * Creates a heartbeat check with the given parameters..
 *
 * Maps to the official StatusCake endpoint POST /heartbeat.
 */
class StatusCakeCreateHeartbeatTest extends AbstractStatusCakeTool
{
    protected const NAME = 'statuscake_create_heartbeat_test';
    protected const DESCRIPTION = 'Creates a heartbeat check with the given parameters.

Official StatusCake endpoint: POST /heartbeat.';
    protected const PARAMETERS = array (
      'body' => array (
        'type' => 'object',
        'description' => 'Form fields matching the StatusCake API schema.',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/heartbeat';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
