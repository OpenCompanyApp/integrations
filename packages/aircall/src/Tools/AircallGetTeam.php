<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * Retrieve a team.
 */
class AircallGetTeam extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_get_team';
    protected const TOOL_DESCRIPTION = 'Retrieve a team.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/teams/{team_id}';
    protected const PATH_KEYS = array (  0 => 'team_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'team_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Aircall resource ID for team id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),);
    protected const DYNAMIC_PATH = false;
}
