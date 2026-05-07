<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * Create a user using the v2 user API.
 */
class AircallCreateUserV2 extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_create_user_v2';
    protected const TOOL_DESCRIPTION = 'Create a user using the v2 user API.';
    protected const METHOD = 'POST';
    protected const PATH = '/v2/users';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'email',  1 => 'first_name',  2 => 'last_name',  3 => 'role_ids',  4 => 'number_ids',);
    protected const PARAMETERS = array (  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'email' =>   array (    'type' => 'string',    'description' => 'Body field: email.',  ),  'first_name' =>   array (    'type' => 'string',    'description' => 'Body field: first_name.',  ),  'last_name' =>   array (    'type' => 'string',    'description' => 'Body field: last_name.',  ),  'role_ids' =>   array (    'type' => 'string',    'description' => 'Body field: role_ids.',  ),  'number_ids' =>   array (    'type' => 'string',    'description' => 'Body field: number_ids.',  ),);
    protected const DYNAMIC_PATH = false;
}
