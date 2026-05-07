<?php

namespace OpenCompany\Integrations\Affinity\Tools;

/**
 * List entries on a saved view.
 */
class AffinityListSavedViewEntries extends AbstractAffinityEndpointTool
{
    protected const TOOL_NAME = 'affinity_list_saved_view_entries';
    protected const TOOL_DESCRIPTION = 'List entries on a saved view.';
    protected const METHOD = 'GET';
    protected const PATH = '/lists/{list_id}/saved-views/{view_id}/list-entries';
    protected const PATH_KEYS = array (  0 => 'list_id',  1 => 'view_id',);
    protected const QUERY_KEYS = array (  0 => 'cursor',  1 => 'limit',);
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'list_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Affinity resource ID for list id.',  ),  'view_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Affinity resource ID for view id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),  'cursor' =>   array (    'type' => 'string',    'description' => 'Query parameter: cursor.',  ),  'limit' =>   array (    'type' => 'string',    'description' => 'Query parameter: limit.',  ),);
    protected const DYNAMIC_PATH = false;
}
