<?php

namespace OpenCompany\Integrations\Affinity\Tools;

/**
 * Get one field value on a list entry.
 */
class AffinityGetListEntryField extends AbstractAffinityEndpointTool
{
    protected const TOOL_NAME = 'affinity_get_list_entry_field';
    protected const TOOL_DESCRIPTION = 'Get one field value on a list entry.';
    protected const METHOD = 'GET';
    protected const PATH = '/lists/{list_id}/list-entries/{list_entry_id}/fields/{field_id}';
    protected const PATH_KEYS = array (  0 => 'list_id',  1 => 'list_entry_id',  2 => 'field_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'list_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Affinity resource ID for list id.',  ),  'list_entry_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Affinity resource ID for list entry id.',  ),  'field_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Affinity resource ID for field id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),);
    protected const DYNAMIC_PATH = false;
}
