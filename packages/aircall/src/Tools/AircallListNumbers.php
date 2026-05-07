<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * List Aircall numbers.
 */
class AircallListNumbers extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_list_numbers';
    protected const TOOL_DESCRIPTION = 'List Aircall numbers.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/numbers';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array (  0 => 'page',  1 => 'per_page',  2 => 'order',);
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),  'page' =>   array (    'type' => 'string',    'description' => 'Query parameter: page.',  ),  'per_page' =>   array (    'type' => 'string',    'description' => 'Query parameter: per_page.',  ),  'order' =>   array (    'type' => 'string',    'description' => 'Query parameter: order.',  ),);
    protected const DYNAMIC_PATH = false;
}
