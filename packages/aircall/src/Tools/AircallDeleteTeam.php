<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * Delete a team.
 */
class AircallDeleteTeam extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_delete_team';
    protected const TOOL_DESCRIPTION = 'Delete a team.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/teams/{team_id}';
    protected const PATH_KEYS = array (  0 => 'team_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'team_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Aircall resource ID for team id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),);
    protected const DYNAMIC_PATH = false;
}
