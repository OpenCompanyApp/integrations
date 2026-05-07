<?php

namespace OpenCompany\Integrations\Affinity\Tools;

/**
 * Get metadata for a list.
 */
class AffinityGetList extends AbstractAffinityEndpointTool
{
    protected const TOOL_NAME = 'affinity_get_list';
    protected const TOOL_DESCRIPTION = 'Get metadata for a list.';
    protected const METHOD = 'GET';
    protected const PATH = '/lists/{list_id}';
    protected const PATH_KEYS = array (  0 => 'list_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'list_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Affinity resource ID for list id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),);
    protected const DYNAMIC_PATH = false;
}
