<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves a team.
 *
 * Maps to the official Rootly endpoint get /v1/teams/{id}.
 */
class RootlyGetTeam extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_team';
    protected const DESCRIPTION = 'Retrieves a team

Official Rootly endpoint: GET /v1/teams/{id}

Retrieves a specific team by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'include' =>
  array (
    'type' => 'string',
    'description' => 'comma separated if needed. eg: users',
    'enum' =>
    array (
      0 => 'users',
      1 => 'schedules',
      2 => 'escalation_policies',
    ),
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/teams/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
