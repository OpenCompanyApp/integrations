<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * Add a user to a team.
 */
class AircallAddUserToTeam extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_add_user_to_team';
    protected const TOOL_DESCRIPTION = 'Add a user to a team.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/teams/{team_id}/users/{user_id}';
    protected const PATH_KEYS = array (  0 => 'team_id',  1 => 'user_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'team_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Aircall resource ID for team id.',  ),  'user_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Aircall resource ID for user id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),);
    protected const DYNAMIC_PATH = false;
}
