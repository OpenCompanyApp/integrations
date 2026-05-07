<?php

namespace OpenCompany\Integrations\Affinity\Tools;

/**
 * Get saved view metadata.
 */
class AffinityGetSavedView extends AbstractAffinityEndpointTool
{
    protected const TOOL_NAME = 'affinity_get_saved_view';
    protected const TOOL_DESCRIPTION = 'Get saved view metadata.';
    protected const METHOD = 'GET';
    protected const PATH = '/lists/{list_id}/saved-views/{view_id}';
    protected const PATH_KEYS = array (  0 => 'list_id',  1 => 'view_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'list_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Affinity resource ID for list id.',  ),  'view_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Affinity resource ID for view id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),);
    protected const DYNAMIC_PATH = false;
}
