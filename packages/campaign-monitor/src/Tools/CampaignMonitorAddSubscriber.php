<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * Add or update a subscriber on a list.
 */
class CampaignMonitorAddSubscriber extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_add_subscriber';
    protected const TOOL_DESCRIPTION = 'Add or update a subscriber on a list.';
    protected const METHOD = 'POST';
    protected const PATH = '/subscribers/{list_id}.json';
    protected const PATH_KEYS = array (  0 => 'list_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'EmailAddress',  1 => 'Name',  2 => 'MobileNumber',  3 => 'CustomFields',  4 => 'Resubscribe',  5 => 'RestartSubscriptionBasedAutoresponders',  6 => 'ConsentToTrack',  7 => 'ConsentToSendSms',);
    protected const PARAMETERS = array (  'list_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Campaign Monitor resource ID for list id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'EmailAddress' =>   array (    'type' => 'string',    'description' => 'Body field: EmailAddress.',  ),  'Name' =>   array (    'type' => 'string',    'description' => 'Body field: Name.',  ),  'MobileNumber' =>   array (    'type' => 'string',    'description' => 'Body field: MobileNumber.',  ),  'CustomFields' =>   array (    'type' => 'array',    'description' => 'Body field: CustomFields.',  ),  'Resubscribe' =>   array (    'type' => 'string',    'description' => 'Body field: Resubscribe.',  ),  'RestartSubscriptionBasedAutoresponders' =>   array (    'type' => 'string',    'description' => 'Body field: RestartSubscriptionBasedAutoresponders.',  ),  'ConsentToTrack' =>   array (    'type' => 'string',    'description' => 'Body field: ConsentToTrack.',  ),  'ConsentToSendSms' =>   array (    'type' => 'string',    'description' => 'Body field: ConsentToSendSms.',  ),);
    protected const DYNAMIC_PATH = false;
}
