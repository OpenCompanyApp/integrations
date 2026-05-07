<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * List campaign recipients.
 */
class CampaignMonitorListCampaignRecipients extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_list_campaign_recipients';
    protected const TOOL_DESCRIPTION = 'List campaign recipients.';
    protected const METHOD = 'GET';
    protected const PATH = '/campaigns/{campaign_id}/recipients.json';
    protected const PATH_KEYS = array (  0 => 'campaign_id',);
    protected const QUERY_KEYS = array (  0 => 'page',  1 => 'pagesize',  2 => 'orderfield',  3 => 'orderdirection',);
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'campaign_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Campaign Monitor resource ID for campaign id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),  'page' =>   array (    'type' => 'string',    'description' => 'Query parameter: page.',  ),  'pagesize' =>   array (    'type' => 'string',    'description' => 'Query parameter: pagesize.',  ),  'orderfield' =>   array (    'type' => 'string',    'description' => 'Query parameter: orderfield.',  ),  'orderdirection' =>   array (    'type' => 'string',    'description' => 'Query parameter: orderdirection.',  ),);
    protected const DYNAMIC_PATH = false;
}
