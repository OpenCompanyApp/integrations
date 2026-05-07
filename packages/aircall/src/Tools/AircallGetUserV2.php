<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * Retrieve a user using the v2 user API.
 */
class AircallGetUserV2 extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_get_user_v2';
    protected const TOOL_DESCRIPTION = 'Retrieve a user using the v2 user API.';
    protected const METHOD = 'GET';
    protected const PATH = '/v2/users/{user_id}';
    protected const PATH_KEYS = array (  0 => 'user_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'user_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Aircall resource ID for user id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),);
    protected const DYNAMIC_PATH = false;
}
