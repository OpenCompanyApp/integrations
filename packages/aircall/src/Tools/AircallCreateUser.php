<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * Create a user.
 */
class AircallCreateUser extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_create_user';
    protected const TOOL_DESCRIPTION = 'Create a user.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/users';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'email',  1 => 'first_name',  2 => 'last_name',  3 => 'available',  4 => 'numbers',  5 => 'is_admin',);
    protected const PARAMETERS = array (  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'email' =>   array (    'type' => 'string',    'description' => 'Body field: email.',  ),  'first_name' =>   array (    'type' => 'string',    'description' => 'Body field: first_name.',  ),  'last_name' =>   array (    'type' => 'string',    'description' => 'Body field: last_name.',  ),  'available' =>   array (    'type' => 'string',    'description' => 'Body field: available.',  ),  'numbers' =>   array (    'type' => 'array',    'description' => 'Body field: numbers.',  ),  'is_admin' =>   array (    'type' => 'string',    'description' => 'Body field: is_admin.',  ),);
    protected const DYNAMIC_PATH = false;
}
