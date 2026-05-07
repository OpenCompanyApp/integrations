<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * Create a subscriber list for a client.
 */
class CampaignMonitorCreateList extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_create_list';
    protected const TOOL_DESCRIPTION = 'Create a subscriber list for a client.';
    protected const METHOD = 'POST';
    protected const PATH = '/lists/{client_id}.json';
    protected const PATH_KEYS = array (  0 => 'client_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'Title',  1 => 'UnsubscribePage',  2 => 'ConfirmedOptIn',  3 => 'ConfirmationSuccessPage',  4 => 'UnsubscribeSetting',);
    protected const PARAMETERS = array (  'client_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Campaign Monitor resource ID for client id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'Title' =>   array (    'type' => 'string',    'description' => 'Body field: Title.',  ),  'UnsubscribePage' =>   array (    'type' => 'string',    'description' => 'Body field: UnsubscribePage.',  ),  'ConfirmedOptIn' =>   array (    'type' => 'string',    'description' => 'Body field: ConfirmedOptIn.',  ),  'ConfirmationSuccessPage' =>   array (    'type' => 'string',    'description' => 'Body field: ConfirmationSuccessPage.',  ),  'UnsubscribeSetting' =>   array (    'type' => 'string',    'description' => 'Body field: UnsubscribeSetting.',  ),);
    protected const DYNAMIC_PATH = false;
}
