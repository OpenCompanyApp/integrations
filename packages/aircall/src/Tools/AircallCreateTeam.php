<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * Create a team.
 */
class AircallCreateTeam extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_create_team';
    protected const TOOL_DESCRIPTION = 'Create a team.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/teams';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'name',  1 => 'user_ids',);
    protected const PARAMETERS = array (  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'name' =>   array (    'type' => 'string',    'description' => 'Body field: name.',  ),  'user_ids' =>   array (    'type' => 'string',    'description' => 'Body field: user_ids.',  ),);
    protected const DYNAMIC_PATH = false;
}
