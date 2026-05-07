<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * Retrieve the currently authenticated user.
 */
class AircallGetCurrentUser extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_get_current_user';
    protected const TOOL_DESCRIPTION = 'Retrieve the currently authenticated user.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/users/me';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),);
    protected const DYNAMIC_PATH = false;
}
