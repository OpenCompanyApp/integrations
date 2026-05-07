<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * Import many subscribers into a list.
 */
class CampaignMonitorImportSubscribers extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_import_subscribers';
    protected const TOOL_DESCRIPTION = 'Import many subscribers into a list.';
    protected const METHOD = 'POST';
    protected const PATH = '/subscribers/{list_id}/import.json';
    protected const PATH_KEYS = array (  0 => 'list_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'Subscribers',  1 => 'Resubscribe',  2 => 'QueueSubscriptionBasedAutoResponders',  3 => 'RestartSubscriptionBasedAutoresponders',);
    protected const PARAMETERS = array (  'list_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Campaign Monitor resource ID for list id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'Subscribers' =>   array (    'type' => 'array',    'description' => 'Body field: Subscribers.',  ),  'Resubscribe' =>   array (    'type' => 'string',    'description' => 'Body field: Resubscribe.',  ),  'QueueSubscriptionBasedAutoResponders' =>   array (    'type' => 'string',    'description' => 'Body field: QueueSubscriptionBasedAutoResponders.',  ),  'RestartSubscriptionBasedAutoresponders' =>   array (    'type' => 'string',    'description' => 'Body field: RestartSubscriptionBasedAutoresponders.',  ),);
    protected const DYNAMIC_PATH = false;
}
