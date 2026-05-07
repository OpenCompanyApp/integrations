<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * Dial a phone number in a user phone app.
 */
class AircallDialUserPhone extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_dial_user_phone';
    protected const TOOL_DESCRIPTION = 'Dial a phone number in a user phone app.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/users/{user_id}/dial';
    protected const PATH_KEYS = array (  0 => 'user_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'number_id',  1 => 'to',);
    protected const PARAMETERS = array (  'user_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Aircall resource ID for user id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'number_id' =>   array (    'type' => 'string',    'description' => 'Body field: number_id.',  ),  'to' =>   array (    'type' => 'string',    'description' => 'Body field: to.',  ),);
    protected const DYNAMIC_PATH = false;
}
