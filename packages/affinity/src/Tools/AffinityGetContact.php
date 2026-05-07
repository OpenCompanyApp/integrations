<?php

namespace OpenCompany\Integrations\Affinity\Tools;

/**
 * Get a person by ID.
 */
class AffinityGetContact extends AbstractAffinityEndpointTool
{
    protected const TOOL_NAME = 'affinity_get_contact';
    protected const TOOL_DESCRIPTION = 'Get a person by ID.';
    protected const METHOD = 'GET';
    protected const PATH = '/persons/{person_id}';
    protected const PATH_KEYS = array (  0 => 'person_id',);
    protected const QUERY_KEYS = array (  0 => 'fieldIds',  1 => 'fieldTypes',);
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'person_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Affinity resource ID for person id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),  'fieldIds' =>   array (    'type' => 'string',    'description' => 'Query parameter: fieldIds.',  ),  'fieldTypes' =>   array (    'type' => 'string',    'description' => 'Query parameter: fieldTypes.',  ),);
    protected const DYNAMIC_PATH = false;
}
