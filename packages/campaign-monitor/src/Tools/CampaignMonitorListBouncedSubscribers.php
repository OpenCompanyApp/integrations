<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * List bounced subscribers on a list.
 */
class CampaignMonitorListBouncedSubscribers extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_list_bounced_subscribers';
    protected const TOOL_DESCRIPTION = 'List bounced subscribers on a list.';
    protected const METHOD = 'GET';
    protected const PATH = '/lists/{list_id}/bounced.json';
    protected const PATH_KEYS = array (  0 => 'list_id',);
    protected const QUERY_KEYS = array (  0 => 'date',  1 => 'page',  2 => 'pagesize',  3 => 'orderfield',  4 => 'orderdirection',);
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'list_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Campaign Monitor resource ID for list id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),  'date' =>   array (    'type' => 'string',    'description' => 'Query parameter: date.',  ),  'page' =>   array (    'type' => 'string',    'description' => 'Query parameter: page.',  ),  'pagesize' =>   array (    'type' => 'string',    'description' => 'Query parameter: pagesize.',  ),  'orderfield' =>   array (    'type' => 'string',    'description' => 'Query parameter: orderfield.',  ),  'orderdirection' =>   array (    'type' => 'string',    'description' => 'Query parameter: orderdirection.',  ),);
    protected const DYNAMIC_PATH = false;
}
