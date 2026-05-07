<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * Call a safe relative Campaign Monitor API path with GET.
 */
class CampaignMonitorApiGet extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_api_get';
    protected const TOOL_DESCRIPTION = 'Call a safe relative Campaign Monitor API path with GET.';
    protected const METHOD = 'GET';
    protected const PATH = '';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'path' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Safe relative API path, for example /clients.json.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),);
    protected const DYNAMIC_PATH = true;
}
