<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * Delete a user.
 */
class AircallDeleteUser extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_delete_user';
    protected const TOOL_DESCRIPTION = 'Delete a user.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/users/{user_id}';
    protected const PATH_KEYS = array (  0 => 'user_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'user_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Aircall resource ID for user id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),);
    protected const DYNAMIC_PATH = false;
}
