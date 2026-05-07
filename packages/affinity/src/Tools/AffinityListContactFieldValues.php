<?php

namespace OpenCompany\Integrations\Affinity\Tools;

/**
 * List field values on a person.
 */
class AffinityListContactFieldValues extends AbstractAffinityEndpointTool
{
    protected const TOOL_NAME = 'affinity_list_contact_field_values';
    protected const TOOL_DESCRIPTION = 'List field values on a person.';
    protected const METHOD = 'GET';
    protected const PATH = '/persons/{person_id}/fields';
    protected const PATH_KEYS = array (  0 => 'person_id',);
    protected const QUERY_KEYS = array (  0 => 'cursor',  1 => 'limit',  2 => 'ids',  3 => 'types',);
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'person_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Affinity resource ID for person id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),  'cursor' =>   array (    'type' => 'string',    'description' => 'Query parameter: cursor.',  ),  'limit' =>   array (    'type' => 'string',    'description' => 'Query parameter: limit.',  ),  'ids' =>   array (    'type' => 'string',    'description' => 'Query parameter: ids.',  ),  'types' =>   array (    'type' => 'string',    'description' => 'Query parameter: types.',  ),);
    protected const DYNAMIC_PATH = false;
}
