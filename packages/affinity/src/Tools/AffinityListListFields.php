<?php

namespace OpenCompany\Integrations\Affinity\Tools;

/**
 * List field metadata for a list.
 */
class AffinityListListFields extends AbstractAffinityEndpointTool
{
    protected const TOOL_NAME = 'affinity_list_list_fields';
    protected const TOOL_DESCRIPTION = 'List field metadata for a list.';
    protected const METHOD = 'GET';
    protected const PATH = '/lists/{list_id}/fields';
    protected const PATH_KEYS = array (  0 => 'list_id',);
    protected const QUERY_KEYS = array (  0 => 'cursor',  1 => 'limit',);
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'list_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Affinity resource ID for list id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),  'cursor' =>   array (    'type' => 'string',    'description' => 'Query parameter: cursor.',  ),  'limit' =>   array (    'type' => 'string',    'description' => 'Query parameter: limit.',  ),);
    protected const DYNAMIC_PATH = false;
}
