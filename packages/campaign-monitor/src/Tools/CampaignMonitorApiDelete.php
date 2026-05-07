<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * Call a safe relative Campaign Monitor API path with DELETE.
 */
class CampaignMonitorApiDelete extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_api_delete';
    protected const TOOL_DESCRIPTION = 'Call a safe relative Campaign Monitor API path with DELETE.';
    protected const METHOD = 'DELETE';
    protected const PATH = '';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'path' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Safe relative API path, for example /clients.json.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),);
    protected const DYNAMIC_PATH = true;
}
