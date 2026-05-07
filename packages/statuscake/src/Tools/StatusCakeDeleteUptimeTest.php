<?php

namespace OpenCompany\Integrations\StatusCake\Tools;

/**
 * Deletes an uptime check with the given id..
 *
 * Maps to the official StatusCake endpoint DELETE /uptime/{test_id}.
 */
class StatusCakeDeleteUptimeTest extends AbstractStatusCakeTool
{
    protected const NAME = 'statuscake_delete_uptime_test';
    protected const DESCRIPTION = 'Deletes an uptime check with the given id.

Official StatusCake endpoint: DELETE /uptime/{test_id}.';
    protected const PARAMETERS = array (
      'test_id' => array (
        'type' => 'string',
        'description' => 'Uptime check ID',
        'required' => true,
      ),
    );
    protected const METHOD = 'DELETE';
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
