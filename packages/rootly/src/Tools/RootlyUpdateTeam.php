<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update a team.
 *
 * Maps to the official Rootly endpoint put /v1/teams/{id}.
 */
class RootlyUpdateTeam extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_team';
    protected const DESCRIPTION = 'Update a team

Official Rootly endpoint: PUT /v1/teams/{id}

Update a specific team by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v1/teams/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
