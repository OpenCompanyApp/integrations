<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

/**
 * Call a safe relative Kit API path with GET.
 */
class ConvertKitApiGet extends AbstractConvertKitEndpointTool
{
    protected const TOOL_NAME = 'convertkit_api_get';
    protected const TOOL_DESCRIPTION = 'Call a safe relative Kit API path with GET.';
    protected const METHOD = 'GET';
    protected const PATH = '';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'path' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Safe relative Kit API path, for example /subscribers.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters such as after, before, per_page, or include_total_count.',  ),);
    protected const DYNAMIC_PATH = true;
}
