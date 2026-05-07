<?php

namespace OpenCompany\Integrations\StatusCake\Tools;

/**
 * Returns an uptime check with the given id..
 *
 * Maps to the official StatusCake endpoint GET /uptime/{test_id}.
 */
class StatusCakeGetUptimeTest extends AbstractStatusCakeTool
{
    protected const NAME = 'statuscake_get_uptime_test';
    protected const DESCRIPTION = 'Returns an uptime check with the given id.

Official StatusCake endpoint: GET /uptime/{test_id}.';
    protected const PARAMETERS = array (
      'test_id' => array (
        'type' => 'string',
        'description' => 'Uptime check ID',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/uptime/{test_id}';
    protected const PATH_PARAMS = array (
      'test_id' => 'test_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
