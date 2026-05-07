<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * Retrieve an Aircall number.
 */
class AircallGetNumber extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_get_number';
    protected const TOOL_DESCRIPTION = 'Retrieve an Aircall number.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/numbers/{number_id}';
    protected const PATH_KEYS = array (  0 => 'number_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'number_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Aircall resource ID for number id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),);
    protected const DYNAMIC_PATH = false;
}
