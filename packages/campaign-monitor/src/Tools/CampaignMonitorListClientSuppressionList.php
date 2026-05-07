<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * List suppressed email addresses for a client.
 */
class CampaignMonitorListClientSuppressionList extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_list_client_suppression_list';
    protected const TOOL_DESCRIPTION = 'List suppressed email addresses for a client.';
    protected const METHOD = 'GET';
    protected const PATH = '/clients/{client_id}/suppressionlist.json';
    protected const PATH_KEYS = array (  0 => 'client_id',);
    protected const QUERY_KEYS = array (  0 => 'page',  1 => 'pagesize',  2 => 'orderfield',  3 => 'orderdirection',);
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'client_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Campaign Monitor resource ID for client id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),  'page' =>   array (    'type' => 'string',    'description' => 'Query parameter: page.',  ),  'pagesize' =>   array (    'type' => 'string',    'description' => 'Query parameter: pagesize.',  ),  'orderfield' =>   array (    'type' => 'string',    'description' => 'Query parameter: orderfield.',  ),  'orderdirection' =>   array (    'type' => 'string',    'description' => 'Query parameter: orderdirection.',  ),);
    protected const DYNAMIC_PATH = false;
}
