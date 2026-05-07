<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * List numbers assigned to a v2 user.
 */
class AircallListUserNumbersV2 extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_list_user_numbers_v2';
    protected const TOOL_DESCRIPTION = 'List numbers assigned to a v2 user.';
    protected const METHOD = 'GET';
    protected const PATH = '/v2/users/{user_id}/numbers';
    protected const PATH_KEYS = array (  0 => 'user_id',);
    protected const QUERY_KEYS = array (  0 => 'page',  1 => 'per_page',);
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'user_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Aircall resource ID for user id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),  'page' =>   array (    'type' => 'string',    'description' => 'Query parameter: page.',  ),  'per_page' =>   array (    'type' => 'string',    'description' => 'Query parameter: per_page.',  ),);
    protected const DYNAMIC_PATH = false;
}
