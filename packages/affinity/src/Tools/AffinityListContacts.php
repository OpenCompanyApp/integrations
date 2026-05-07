<?php

namespace OpenCompany\Integrations\Affinity\Tools;

/**
 * List persons in Affinity.
 */
class AffinityListContacts extends AbstractAffinityEndpointTool
{
    protected const TOOL_NAME = 'affinity_list_contacts';
    protected const TOOL_DESCRIPTION = 'List persons in Affinity.';
    protected const METHOD = 'GET';
    protected const PATH = '/persons';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array (  0 => 'cursor',  1 => 'limit',  2 => 'fieldIds',  3 => 'fieldTypes',);
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),  'cursor' =>   array (    'type' => 'string',    'description' => 'Query parameter: cursor.',  ),  'limit' =>   array (    'type' => 'string',    'description' => 'Query parameter: limit.',  ),  'fieldIds' =>   array (    'type' => 'string',    'description' => 'Query parameter: fieldIds.',  ),  'fieldTypes' =>   array (    'type' => 'string',    'description' => 'Query parameter: fieldTypes.',  ),);
    protected const DYNAMIC_PATH = false;
}
