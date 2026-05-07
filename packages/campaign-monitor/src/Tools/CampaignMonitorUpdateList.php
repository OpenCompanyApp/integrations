<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * Update a subscriber list.
 */
class CampaignMonitorUpdateList extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_update_list';
    protected const TOOL_DESCRIPTION = 'Update a subscriber list.';
    protected const METHOD = 'PUT';
    protected const PATH = '/lists/{list_id}.json';
    protected const PATH_KEYS = array (  0 => 'list_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'Title',  1 => 'UnsubscribePage',  2 => 'ConfirmedOptIn',  3 => 'ConfirmationSuccessPage',  4 => 'UnsubscribeSetting',);
    protected const PARAMETERS = array (  'list_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Campaign Monitor resource ID for list id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'Title' =>   array (    'type' => 'string',    'description' => 'Body field: Title.',  ),  'UnsubscribePage' =>   array (    'type' => 'string',    'description' => 'Body field: UnsubscribePage.',  ),  'ConfirmedOptIn' =>   array (    'type' => 'string',    'description' => 'Body field: ConfirmedOptIn.',  ),  'ConfirmationSuccessPage' =>   array (    'type' => 'string',    'description' => 'Body field: ConfirmationSuccessPage.',  ),  'UnsubscribeSetting' =>   array (    'type' => 'string',    'description' => 'Body field: UnsubscribeSetting.',  ),);
    protected const DYNAMIC_PATH = false;
}
