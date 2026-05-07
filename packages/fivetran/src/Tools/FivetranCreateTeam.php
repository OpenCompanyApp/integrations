<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Create a Team.
 *
 * Maps to the official Fivetran endpoint post /v1/teams.
 */
class FivetranCreateTeam extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_create_team';
    protected const DESCRIPTION = 'Create a Team

Official Fivetran endpoint: POST /v1/teams

Creates a new team in your Fivetran account';
    protected const PARAMETERS = array (
  'accept' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Accept` from the official Fivetran API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Fivetran API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/teams';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
