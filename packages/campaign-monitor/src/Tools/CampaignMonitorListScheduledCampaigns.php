<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * List scheduled campaigns for a client.
 */
class CampaignMonitorListScheduledCampaigns extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_list_scheduled_campaigns';
    protected const TOOL_DESCRIPTION = 'List scheduled campaigns for a client.';
    protected const METHOD = 'GET';
    protected const PATH = '/clients/{client_id}/scheduled.json';
    protected const PATH_KEYS = array (  0 => 'client_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'client_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Campaign Monitor resource ID for client id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),);
    protected const DYNAMIC_PATH = false;
}
