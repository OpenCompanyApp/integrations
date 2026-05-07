<?php

namespace OpenCompany\Integrations\Affinity\Tools;

/**
 * List entries on a list.
 */
class AffinityListListEntries extends AbstractAffinityEndpointTool
{
    protected const TOOL_NAME = 'affinity_list_list_entries';
    protected const TOOL_DESCRIPTION = 'List entries on a list.';
    protected const METHOD = 'GET';
    protected const PATH = '/lists/{list_id}/list-entries';
    protected const PATH_KEYS = array (  0 => 'list_id',);
    protected const QUERY_KEYS = array (  0 => 'cursor',  1 => 'limit',  2 => 'fieldIds',  3 => 'fieldTypes',);
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'list_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Affinity resource ID for list id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),  'cursor' =>   array (    'type' => 'string',    'description' => 'Query parameter: cursor.',  ),  'limit' =>   array (    'type' => 'string',    'description' => 'Query parameter: limit.',  ),  'fieldIds' =>   array (    'type' => 'string',    'description' => 'Query parameter: fieldIds.',  ),  'fieldTypes' =>   array (    'type' => 'string',    'description' => 'Query parameter: fieldTypes.',  ),);
    protected const DYNAMIC_PATH = false;
}
