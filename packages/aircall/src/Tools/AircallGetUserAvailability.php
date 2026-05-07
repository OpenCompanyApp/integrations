<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * Retrieve one user availability.
 */
class AircallGetUserAvailability extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_get_user_availability';
    protected const TOOL_DESCRIPTION = 'Retrieve one user availability.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/users/{user_id}/availability';
    protected const PATH_KEYS = array (  0 => 'user_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'user_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Aircall resource ID for user id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),);
    protected const DYNAMIC_PATH = false;
}
