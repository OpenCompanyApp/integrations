<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * Update a user using the v2 user API.
 */
class AircallUpdateUserV2 extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_update_user_v2';
    protected const TOOL_DESCRIPTION = 'Update a user using the v2 user API.';
    protected const METHOD = 'PUT';
    protected const PATH = '/v2/users/{user_id}';
    protected const PATH_KEYS = array (  0 => 'user_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'first_name',  1 => 'last_name',  2 => 'role_ids',  3 => 'number_ids',);
    protected const PARAMETERS = array (  'user_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Aircall resource ID for user id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'first_name' =>   array (    'type' => 'string',    'description' => 'Body field: first_name.',  ),  'last_name' =>   array (    'type' => 'string',    'description' => 'Body field: last_name.',  ),  'role_ids' =>   array (    'type' => 'string',    'description' => 'Body field: role_ids.',  ),  'number_ids' =>   array (    'type' => 'string',    'description' => 'Body field: number_ids.',  ),);
    protected const DYNAMIC_PATH = false;
}
