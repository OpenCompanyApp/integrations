<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * Update subscriber details by email address.
 */
class CampaignMonitorUpdateSubscriber extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_update_subscriber';
    protected const TOOL_DESCRIPTION = 'Update subscriber details by email address.';
    protected const METHOD = 'PUT';
    protected const PATH = '/subscribers/{list_id}.json';
    protected const PATH_KEYS = array (  0 => 'list_id',);
    protected const QUERY_KEYS = array (  0 => 'email',);
    protected const BODY_KEYS = array (  0 => 'EmailAddress',  1 => 'Name',  2 => 'MobileNumber',  3 => 'CustomFields',  4 => 'Resubscribe',  5 => 'RestartSubscriptionBasedAutoresponders',  6 => 'ConsentToTrack',  7 => 'ConsentToSendSms',);
    protected const PARAMETERS = array (  'list_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Campaign Monitor resource ID for list id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),  'email' =>   array (    'type' => 'string',    'description' => 'Query parameter: email.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'EmailAddress' =>   array (    'type' => 'string',    'description' => 'Body field: EmailAddress.',  ),  'Name' =>   array (    'type' => 'string',    'description' => 'Body field: Name.',  ),  'MobileNumber' =>   array (    'type' => 'string',    'description' => 'Body field: MobileNumber.',  ),  'CustomFields' =>   array (    'type' => 'array',    'description' => 'Body field: CustomFields.',  ),  'Resubscribe' =>   array (    'type' => 'string',    'description' => 'Body field: Resubscribe.',  ),  'RestartSubscriptionBasedAutoresponders' =>   array (    'type' => 'string',    'description' => 'Body field: RestartSubscriptionBasedAutoresponders.',  ),  'ConsentToTrack' =>   array (    'type' => 'string',    'description' => 'Body field: ConsentToTrack.',  ),  'ConsentToSendSms' =>   array (    'type' => 'string',    'description' => 'Body field: ConsentToSendSms.',  ),);
    protected const DYNAMIC_PATH = false;
}
