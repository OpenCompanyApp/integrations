<?php

namespace OpenCompany\Integrations\Affinity\Tools;

/**
 * Batch update field values on a list entry.
 */
class AffinityBatchUpdateListEntryFields extends AbstractAffinityEndpointTool
{
    protected const TOOL_NAME = 'affinity_batch_update_list_entry_fields';
    protected const TOOL_DESCRIPTION = 'Batch update field values on a list entry.';
    protected const METHOD = 'POST';
    protected const PATH = '/lists/{list_id}/list-entries/{list_entry_id}/fields';
    protected const PATH_KEYS = array (  0 => 'list_id',  1 => 'list_entry_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'operations',);
    protected const PARAMETERS = array (  'list_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Affinity resource ID for list id.',  ),  'list_entry_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Affinity resource ID for list entry id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'operations' =>   array (    'type' => 'array',    'description' => 'Body field: operations.',  ),);
    protected const DYNAMIC_PATH = false;
}
