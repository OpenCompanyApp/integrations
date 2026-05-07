<?php

namespace OpenCompany\Integrations\Affinity\Tools;

/**
 * List call interactions.
 */
class AffinityListCalls extends AbstractAffinityEndpointTool
{
    protected const TOOL_NAME = 'affinity_list_calls';
    protected const TOOL_DESCRIPTION = 'List call interactions.';
    protected const METHOD = 'GET';
    protected const PATH = '/calls';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array (  0 => 'cursor',  1 => 'limit',  2 => 'filter',);
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),  'cursor' =>   array (    'type' => 'string',    'description' => 'Query parameter: cursor.',  ),  'limit' =>   array (    'type' => 'string',    'description' => 'Query parameter: limit.',  ),  'filter' =>   array (    'type' => 'string',    'description' => 'Query parameter: filter.',  ),);
    protected const DYNAMIC_PATH = false;
}
