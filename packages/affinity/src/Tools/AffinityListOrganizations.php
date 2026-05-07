<?php

namespace OpenCompany\Integrations\Affinity\Tools;

/**
 * List companies in Affinity.
 */
class AffinityListOrganizations extends AbstractAffinityEndpointTool
{
    protected const TOOL_NAME = 'affinity_list_organizations';
    protected const TOOL_DESCRIPTION = 'List companies in Affinity.';
    protected const METHOD = 'GET';
    protected const PATH = '/companies';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array (  0 => 'cursor',  1 => 'limit',  2 => 'fieldIds',  3 => 'fieldTypes',);
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),  'cursor' =>   array (    'type' => 'string',    'description' => 'Query parameter: cursor.',  ),  'limit' =>   array (    'type' => 'string',    'description' => 'Query parameter: limit.',  ),  'fieldIds' =>   array (    'type' => 'string',    'description' => 'Query parameter: fieldIds.',  ),  'fieldTypes' =>   array (    'type' => 'string',    'description' => 'Query parameter: fieldTypes.',  ),);
    protected const DYNAMIC_PATH = false;
}
