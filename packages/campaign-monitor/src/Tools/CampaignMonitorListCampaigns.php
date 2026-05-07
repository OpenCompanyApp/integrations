<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * List sent campaigns for a client.
 */
class CampaignMonitorListCampaigns extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_list_campaigns';
    protected const TOOL_DESCRIPTION = 'List sent campaigns for a client.';
    protected const METHOD = 'GET';
    protected const PATH = '/clients/{client_id}/campaigns.json';
    protected const PATH_KEYS = array (  0 => 'client_id',);
    protected const QUERY_KEYS = array (  0 => 'sentFromDate',  1 => 'sentToDate',  2 => 'tags',  3 => 'page',  4 => 'pagesize',  5 => 'orderdirection',);
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'client_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Campaign Monitor resource ID for client id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),  'sentFromDate' =>   array (    'type' => 'string',    'description' => 'Query parameter: sentFromDate.',  ),  'sentToDate' =>   array (    'type' => 'string',    'description' => 'Query parameter: sentToDate.',  ),  'tags' =>   array (    'type' => 'string',    'description' => 'Query parameter: tags.',  ),  'page' =>   array (    'type' => 'string',    'description' => 'Query parameter: page.',  ),  'pagesize' =>   array (    'type' => 'string',    'description' => 'Query parameter: pagesize.',  ),  'orderdirection' =>   array (    'type' => 'string',    'description' => 'Query parameter: orderdirection.',  ),);
    protected const DYNAMIC_PATH = false;
}
