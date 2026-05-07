<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * Update a user.
 */
class AircallUpdateUser extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_update_user';
    protected const TOOL_DESCRIPTION = 'Update a user.';
    protected const METHOD = 'PUT';
    protected const PATH = '/v1/users/{user_id}';
    protected const PATH_KEYS = array (  0 => 'user_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'first_name',  1 => 'last_name',  2 => 'available',  3 => 'numbers',);
    protected const PARAMETERS = array (  'user_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Aircall resource ID for user id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'first_name' =>   array (    'type' => 'string',    'description' => 'Body field: first_name.',  ),  'last_name' =>   array (    'type' => 'string',    'description' => 'Body field: last_name.',  ),  'available' =>   array (    'type' => 'string',    'description' => 'Body field: available.',  ),  'numbers' =>   array (    'type' => 'array',    'description' => 'Body field: numbers.',  ),);
    protected const DYNAMIC_PATH = false;
}
