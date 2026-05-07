<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * Remove a user from a team.
 */
class AircallRemoveUserFromTeam extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_remove_user_from_team';
    protected const TOOL_DESCRIPTION = 'Remove a user from a team.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/teams/{team_id}/users/{user_id}';
    protected const PATH_KEYS = array (  0 => 'team_id',  1 => 'user_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'team_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Aircall resource ID for team id.',  ),  'user_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Aircall resource ID for user id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),);
    protected const DYNAMIC_PATH = false;
}
