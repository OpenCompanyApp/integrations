<?php

namespace OpenCompany\Integrations\Affinity\Tools;

/**
 * Update one field value on a list entry.
 */
class AffinityUpdateListEntryField extends AbstractAffinityEndpointTool
{
    protected const TOOL_NAME = 'affinity_update_list_entry_field';
    protected const TOOL_DESCRIPTION = 'Update one field value on a list entry.';
    protected const METHOD = 'POST';
    protected const PATH = '/lists/{list_id}/list-entries/{list_entry_id}/fields/{field_id}';
    protected const PATH_KEYS = array (  0 => 'list_id',  1 => 'list_entry_id',  2 => 'field_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'value',);
    protected const PARAMETERS = array (  'list_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Affinity resource ID for list id.',  ),  'list_entry_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Affinity resource ID for list entry id.',  ),  'field_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Affinity resource ID for field id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'value' =>   array (    'type' => 'string',    'description' => 'Body field: value.',  ),);
    protected const DYNAMIC_PATH = false;
}
