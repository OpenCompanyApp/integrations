<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * Transfer a call to a user, team, or external phone number.
 */
class AircallTransferCall extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_transfer_call';
    protected const TOOL_DESCRIPTION = 'Transfer a call to a user, team, or external phone number.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/calls/{call_id}/transfers';
    protected const PATH_KEYS = array (  0 => 'call_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'user_id',  1 => 'team_id',  2 => 'phone_number',);
    protected const PARAMETERS = array (  'call_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Aircall resource ID for call id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'user_id' =>   array (    'type' => 'string',    'description' => 'Body field: user_id.',  ),  'team_id' =>   array (    'type' => 'string',    'description' => 'Body field: team_id.',  ),  'phone_number' =>   array (    'type' => 'string',    'description' => 'Body field: phone_number.',  ),);
    protected const DYNAMIC_PATH = false;
}
