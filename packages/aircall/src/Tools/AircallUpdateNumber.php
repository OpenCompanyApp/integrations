<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * Update an Aircall number.
 */
class AircallUpdateNumber extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_update_number';
    protected const TOOL_DESCRIPTION = 'Update an Aircall number.';
    protected const METHOD = 'PUT';
    protected const PATH = '/v1/numbers/{number_id}';
    protected const PATH_KEYS = array (  0 => 'number_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'name',  1 => 'open',  2 => 'users',  3 => 'teams',  4 => 'callback_request_enabled',  5 => 'prevent_missed_calls',);
    protected const PARAMETERS = array (  'number_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Aircall resource ID for number id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'name' =>   array (    'type' => 'string',    'description' => 'Body field: name.',  ),  'open' =>   array (    'type' => 'string',    'description' => 'Body field: open.',  ),  'users' =>   array (    'type' => 'array',    'description' => 'Body field: users.',  ),  'teams' =>   array (    'type' => 'array',    'description' => 'Body field: teams.',  ),  'callback_request_enabled' =>   array (    'type' => 'string',    'description' => 'Body field: callback_request_enabled.',  ),  'prevent_missed_calls' =>   array (    'type' => 'string',    'description' => 'Body field: prevent_missed_calls.',  ),);
    protected const DYNAMIC_PATH = false;
}
