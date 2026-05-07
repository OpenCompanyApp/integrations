<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * Create a user dialer campaign.
 */
class AircallCreateDialerCampaign extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_create_dialer_campaign';
    protected const TOOL_DESCRIPTION = 'Create a user dialer campaign.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/users/{user_id}/dialer_campaign';
    protected const PATH_KEYS = array (  0 => 'user_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'name',  1 => 'number_id',  2 => 'phone_numbers',);
    protected const PARAMETERS = array (  'user_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Aircall resource ID for user id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'name' =>   array (    'type' => 'string',    'description' => 'Body field: name.',  ),  'number_id' =>   array (    'type' => 'string',    'description' => 'Body field: number_id.',  ),  'phone_numbers' =>   array (    'type' => 'array',    'description' => 'Body field: phone_numbers.',  ),);
    protected const DYNAMIC_PATH = false;
}
