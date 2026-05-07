<?php

namespace OpenCompany\Integrations\StatusCake\Tools;

/**
 * Returns a list of heartbeat checks for an account..
 *
 * Maps to the official StatusCake endpoint GET /heartbeat.
 */
class StatusCakeListHeartbeatTests extends AbstractStatusCakeTool
{
    protected const NAME = 'statuscake_list_heartbeat_tests';
    protected const DESCRIPTION = 'Returns a list of heartbeat checks for an account.

Official StatusCake endpoint: GET /heartbeat.';
    protected const PARAMETERS = array (
      'status' => array (
        'type' => 'string',
        'description' => 'Heartbeat check status',
        'required' => false,
        'enum' => array (
          'down',
          'up',
        ),
      ),
      'page' => array (
        'type' => 'integer',
        'description' => 'Page of results',
        'required' => false,
      ),
      'limit' => array (
        'type' => 'integer',
        'description' => 'The number of heartbeat checks to return per page',
        'required' => false,
      ),
      'tags' => array (
        'type' => 'string',
        'description' => 'Comma separated list of tags assocaited with a check',
        'required' => false,
      ),
      'matchany' => array (
        'type' => 'boolean',
        'description' => 'Include heartbeat checks in response that match any specified tag or all tags. This parameter does not take a value. The absence of this paratemer equates to `false` whilst the presence of thie paramerter equates to `true`.',
        'required' => false,
      ),
      'nouptime' => array (
        'type' => 'boolean',
        'description' => 'Do not calculate uptime percentages for results. This parameter does not take a value. The absence of this paratemer equates to `false` whilst the presence of thie paramerter equates to `true`.',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/heartbeat';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
      'status' => 'status',
      'page' => 'page',
      'limit' => 'limit',
      'tags' => 'tags',
      'matchany' => 'matchany',
      'nouptime' => 'nouptime',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
