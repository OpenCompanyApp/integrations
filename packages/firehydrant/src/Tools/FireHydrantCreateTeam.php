<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create a team.
 *
 * Maps to the official FireHydrant endpoint post /v1/teams.
 */
class FireHydrantCreateTeam extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_team';
    protected const DESCRIPTION = 'Create a team

Official FireHydrant endpoint: POST /v1/teams

Create a new team';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/teams';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
