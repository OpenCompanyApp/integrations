<?php

namespace OpenCompany\Integrations\Affinity\Tools;

/**
 * List list entries for a person.
 */
class AffinityListContactListEntries extends AbstractAffinityEndpointTool
{
    protected const TOOL_NAME = 'affinity_list_contact_list_entries';
    protected const TOOL_DESCRIPTION = 'List list entries for a person.';
    protected const METHOD = 'GET';
    protected const PATH = '/persons/{person_id}/list-entries';
    protected const PATH_KEYS = array (  0 => 'person_id',);
    protected const QUERY_KEYS = array (  0 => 'cursor',  1 => 'limit',  2 => 'fieldIds',  3 => 'fieldTypes',);
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'person_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Affinity resource ID for person id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),  'cursor' =>   array (    'type' => 'string',    'description' => 'Query parameter: cursor.',  ),  'limit' =>   array (    'type' => 'string',    'description' => 'Query parameter: limit.',  ),  'fieldIds' =>   array (    'type' => 'string',    'description' => 'Query parameter: fieldIds.',  ),  'fieldTypes' =>   array (    'type' => 'string',    'description' => 'Query parameter: fieldTypes.',  ),);
    protected const DYNAMIC_PATH = false;
}
