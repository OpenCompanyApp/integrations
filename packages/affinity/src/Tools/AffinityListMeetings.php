<?php

namespace OpenCompany\Integrations\Affinity\Tools;

/**
 * List meeting interactions.
 */
class AffinityListMeetings extends AbstractAffinityEndpointTool
{
    protected const TOOL_NAME = 'affinity_list_meetings';
    protected const TOOL_DESCRIPTION = 'List meeting interactions.';
    protected const METHOD = 'GET';
    protected const PATH = '/meetings';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array (  0 => 'cursor',  1 => 'limit',  2 => 'filter',);
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),  'cursor' =>   array (    'type' => 'string',    'description' => 'Query parameter: cursor.',  ),  'limit' =>   array (    'type' => 'string',    'description' => 'Query parameter: limit.',  ),  'filter' =>   array (    'type' => 'string',    'description' => 'Query parameter: filter.',  ),);
    protected const DYNAMIC_PATH = false;
}
