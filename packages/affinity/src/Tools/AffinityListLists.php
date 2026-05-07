<?php

namespace OpenCompany\Integrations\Affinity\Tools;

/**
 * List Affinity lists.
 */
class AffinityListLists extends AbstractAffinityEndpointTool
{
    protected const TOOL_NAME = 'affinity_list_lists';
    protected const TOOL_DESCRIPTION = 'List Affinity lists.';
    protected const METHOD = 'GET';
    protected const PATH = '/lists';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array (  0 => 'cursor',  1 => 'limit',);
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),  'cursor' =>   array (    'type' => 'string',    'description' => 'Query parameter: cursor.',  ),  'limit' =>   array (    'type' => 'string',    'description' => 'Query parameter: limit.',  ),);
    protected const DYNAMIC_PATH = false;
}
