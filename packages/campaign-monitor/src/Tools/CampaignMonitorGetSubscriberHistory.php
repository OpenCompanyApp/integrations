<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * Get subscriber history by email address.
 */
class CampaignMonitorGetSubscriberHistory extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_get_subscriber_history';
    protected const TOOL_DESCRIPTION = 'Get subscriber history by email address.';
    protected const METHOD = 'GET';
    protected const PATH = '/subscribers/{list_id}/history.json';
    protected const PATH_KEYS = array (  0 => 'list_id',);
    protected const QUERY_KEYS = array (  0 => 'email',);
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'list_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Campaign Monitor resource ID for list id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),  'email' =>   array (    'type' => 'string',    'description' => 'Query parameter: email.',  ),);
    protected const DYNAMIC_PATH = false;
}
