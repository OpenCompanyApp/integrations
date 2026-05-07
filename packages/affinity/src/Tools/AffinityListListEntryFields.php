<?php

namespace OpenCompany\Integrations\Affinity\Tools;

/**
 * List field values on a list entry.
 */
class AffinityListListEntryFields extends AbstractAffinityEndpointTool
{
    protected const TOOL_NAME = 'affinity_list_list_entry_fields';
    protected const TOOL_DESCRIPTION = 'List field values on a list entry.';
    protected const METHOD = 'GET';
    protected const PATH = '/lists/{list_id}/list-entries/{list_entry_id}/fields';
    protected const PATH_KEYS = array (  0 => 'list_id',  1 => 'list_entry_id',);
    protected const QUERY_KEYS = array (  0 => 'cursor',  1 => 'limit',  2 => 'ids',  3 => 'types',);
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'list_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Affinity resource ID for list id.',  ),  'list_entry_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Affinity resource ID for list entry id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),  'cursor' =>   array (    'type' => 'string',    'description' => 'Query parameter: cursor.',  ),  'limit' =>   array (    'type' => 'string',    'description' => 'Query parameter: limit.',  ),  'ids' =>   array (    'type' => 'string',    'description' => 'Query parameter: ids.',  ),  'types' =>   array (    'type' => 'string',    'description' => 'Query parameter: types.',  ),);
    protected const DYNAMIC_PATH = false;
}
