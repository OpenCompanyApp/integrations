<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

/**
 * Call a safe relative Kit API path with PUT.
 */
class ConvertKitApiPut extends AbstractConvertKitEndpointTool
{
    protected const TOOL_NAME = 'convertkit_api_put';
    protected const TOOL_DESCRIPTION = 'Call a safe relative Kit API path with PUT.';
    protected const METHOD = 'PUT';
    protected const PATH = '';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'path' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Safe relative Kit API path, for example /subscribers.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters such as after, before, per_page, or include_total_count.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),);
    protected const DYNAMIC_PATH = true;
}
