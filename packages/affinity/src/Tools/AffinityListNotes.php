<?php

namespace OpenCompany\Integrations\Affinity\Tools;

/**
 * List notes.
 */
class AffinityListNotes extends AbstractAffinityEndpointTool
{
    protected const TOOL_NAME = 'affinity_list_notes';
    protected const TOOL_DESCRIPTION = 'List notes.';
    protected const METHOD = 'GET';
    protected const PATH = '/notes';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array (  0 => 'cursor',  1 => 'limit',  2 => 'filter',);
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),  'cursor' =>   array (    'type' => 'string',    'description' => 'Query parameter: cursor.',  ),  'limit' =>   array (    'type' => 'string',    'description' => 'Query parameter: limit.',  ),  'filter' =>   array (    'type' => 'string',    'description' => 'Query parameter: filter.',  ),);
    protected const DYNAMIC_PATH = false;
}
