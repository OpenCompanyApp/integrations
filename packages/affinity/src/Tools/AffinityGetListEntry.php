<?php

namespace OpenCompany\Integrations\Affinity\Tools;

/**
 * Get one list entry.
 */
class AffinityGetListEntry extends AbstractAffinityEndpointTool
{
    protected const TOOL_NAME = 'affinity_get_list_entry';
    protected const TOOL_DESCRIPTION = 'Get one list entry.';
    protected const METHOD = 'GET';
    protected const PATH = '/lists/{list_id}/list-entries/{list_entry_id}';
    protected const PATH_KEYS = array (  0 => 'list_id',  1 => 'list_entry_id',);
    protected const QUERY_KEYS = array (  0 => 'fieldIds',  1 => 'fieldTypes',);
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'list_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Affinity resource ID for list id.',  ),  'list_entry_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Affinity resource ID for list entry id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),  'fieldIds' =>   array (    'type' => 'string',    'description' => 'Query parameter: fieldIds.',  ),  'fieldTypes' =>   array (    'type' => 'string',    'description' => 'Query parameter: fieldTypes.',  ),);
    protected const DYNAMIC_PATH = false;
}
