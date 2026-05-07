<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * List webhooks.
 */
class AircallListWebhooks extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_list_webhooks';
    protected const TOOL_DESCRIPTION = 'List webhooks.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/webhooks';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array (  0 => 'page',  1 => 'per_page',);
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),  'page' =>   array (    'type' => 'string',    'description' => 'Query parameter: page.',  ),  'per_page' =>   array (    'type' => 'string',    'description' => 'Query parameter: per_page.',  ),);
    protected const DYNAMIC_PATH = false;
}
