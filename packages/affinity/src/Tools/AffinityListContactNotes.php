<?php

namespace OpenCompany\Integrations\Affinity\Tools;

/**
 * List notes related to a person.
 */
class AffinityListContactNotes extends AbstractAffinityEndpointTool
{
    protected const TOOL_NAME = 'affinity_list_contact_notes';
    protected const TOOL_DESCRIPTION = 'List notes related to a person.';
    protected const METHOD = 'GET';
    protected const PATH = '/persons/{person_id}/notes';
    protected const PATH_KEYS = array (  0 => 'person_id',);
    protected const QUERY_KEYS = array (  0 => 'cursor',  1 => 'limit',  2 => 'filter',);
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'person_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Affinity resource ID for person id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),  'cursor' =>   array (    'type' => 'string',    'description' => 'Query parameter: cursor.',  ),  'limit' =>   array (    'type' => 'string',    'description' => 'Query parameter: limit.',  ),  'filter' =>   array (    'type' => 'string',    'description' => 'Query parameter: filter.',  ),);
    protected const DYNAMIC_PATH = false;
}
