<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * Delete a phone number from a dialer campaign.
 */
class AircallDeleteDialerCampaignPhoneNumber extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_delete_dialer_campaign_phone_number';
    protected const TOOL_DESCRIPTION = 'Delete a phone number from a dialer campaign.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/users/{user_id}/dialer_campaign/phone_numbers/{phone_number_id}';
    protected const PATH_KEYS = array (  0 => 'user_id',  1 => 'phone_number_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'user_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Aircall resource ID for user id.',  ),  'phone_number_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Aircall resource ID for phone number id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),);
    protected const DYNAMIC_PATH = false;
}
