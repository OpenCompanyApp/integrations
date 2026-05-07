<?php

namespace OpenCompany\Integrations\Affinity\Tools;

/**
 * Call a safe relative Affinity API path with GET.
 */
class AffinityApiGet extends AbstractAffinityEndpointTool
{
    protected const TOOL_NAME = 'affinity_api_get';
    protected const TOOL_DESCRIPTION = 'Call a safe relative Affinity API path with GET.';
    protected const METHOD = 'GET';
    protected const PATH = '';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'path' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Safe relative API path, for example /persons.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),);
    protected const DYNAMIC_PATH = true;
}
