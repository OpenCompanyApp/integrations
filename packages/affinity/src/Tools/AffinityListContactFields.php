<?php

namespace OpenCompany\Integrations\Affinity\Tools;

/**
 * List person field metadata.
 */
class AffinityListContactFields extends AbstractAffinityEndpointTool
{
    protected const TOOL_NAME = 'affinity_list_contact_fields';
    protected const TOOL_DESCRIPTION = 'List person field metadata.';
    protected const METHOD = 'GET';
    protected const PATH = '/persons/fields';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array (  0 => 'cursor',  1 => 'limit',  2 => 'types',);
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),  'cursor' =>   array (    'type' => 'string',    'description' => 'Query parameter: cursor.',  ),  'limit' =>   array (    'type' => 'string',    'description' => 'Query parameter: limit.',  ),  'types' =>   array (    'type' => 'string',    'description' => 'Query parameter: types.',  ),);
    protected const DYNAMIC_PATH = false;
}
