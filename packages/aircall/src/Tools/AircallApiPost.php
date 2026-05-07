<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * Call a safe relative Aircall API path with POST.
 */
class AircallApiPost extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_api_post';
    protected const TOOL_DESCRIPTION = 'Call a safe relative Aircall API path with POST.';
    protected const METHOD = 'POST';
    protected const PATH = '';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'path' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Safe relative API path, for example /calls.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),);
    protected const DYNAMIC_PATH = true;
}
