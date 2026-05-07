<?php

namespace OpenCompany\Integrations\Affinity\Tools;

/**
 * Get a single field value on a person.
 */
class AffinityGetContactFieldValue extends AbstractAffinityEndpointTool
{
    protected const TOOL_NAME = 'affinity_get_contact_field_value';
    protected const TOOL_DESCRIPTION = 'Get a single field value on a person.';
    protected const METHOD = 'GET';
    protected const PATH = '/persons/{person_id}/fields/{field_id}';
    protected const PATH_KEYS = array (  0 => 'person_id',  1 => 'field_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'person_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Affinity resource ID for person id.',  ),  'field_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Affinity resource ID for field id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),);
    protected const DYNAMIC_PATH = false;
}
