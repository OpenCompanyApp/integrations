<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates a team.
 *
 * Maps to the official Rootly endpoint post /v1/teams.
 */
class RootlyCreateTeam extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_team';
    protected const DESCRIPTION = 'Creates a team

Official Rootly endpoint: POST /v1/teams

Creates a new team from provided data';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
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
