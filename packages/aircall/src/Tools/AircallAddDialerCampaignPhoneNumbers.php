<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * Add phone numbers to a dialer campaign.
 */
class AircallAddDialerCampaignPhoneNumbers extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_add_dialer_campaign_phone_numbers';
    protected const TOOL_DESCRIPTION = 'Add phone numbers to a dialer campaign.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/users/{user_id}/dialer_campaign/phone_numbers';
    protected const PATH_KEYS = array (  0 => 'user_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'phone_numbers',);
    protected const PARAMETERS = array (  'user_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Aircall resource ID for user id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'phone_numbers' =>   array (    'type' => 'array',    'description' => 'Body field: phone_numbers.',  ),);
    protected const DYNAMIC_PATH = false;
}
