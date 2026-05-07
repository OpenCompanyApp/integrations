<?php

namespace OpenCompany\Integrations\Affinity\Tools;

/**
 * List lists where a person appears.
 */
class AffinityListContactLists extends AbstractAffinityEndpointTool
{
    protected const TOOL_NAME = 'affinity_list_contact_lists';
    protected const TOOL_DESCRIPTION = 'List lists where a person appears.';
    protected const METHOD = 'GET';
    protected const PATH = '/persons/{person_id}/lists';
    protected const PATH_KEYS = array (  0 => 'person_id',);
    protected const QUERY_KEYS = array (  0 => 'cursor',  1 => 'limit',);
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'person_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Affinity resource ID for person id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),  'cursor' =>   array (    'type' => 'string',    'description' => 'Query parameter: cursor.',  ),  'limit' =>   array (    'type' => 'string',    'description' => 'Query parameter: limit.',  ),);
    protected const DYNAMIC_PATH = false;
}
