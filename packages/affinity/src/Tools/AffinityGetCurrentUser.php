<?php

namespace OpenCompany\Integrations\Affinity\Tools;

/**
 * Get the authenticated Affinity user and API permissions.
 */
class AffinityGetCurrentUser extends AbstractAffinityEndpointTool
{
    protected const TOOL_NAME = 'affinity_get_current_user';
    protected const TOOL_DESCRIPTION = 'Get the authenticated Affinity user and API permissions.';
    protected const METHOD = 'GET';
    protected const PATH = '/auth/user';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),);
    protected const DYNAMIC_PATH = false;
}
