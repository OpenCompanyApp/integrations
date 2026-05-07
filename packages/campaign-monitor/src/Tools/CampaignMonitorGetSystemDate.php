<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * Get the current Campaign Monitor system date.
 */
class CampaignMonitorGetSystemDate extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_get_system_date';
    protected const TOOL_DESCRIPTION = 'Get the current Campaign Monitor system date.';
    protected const METHOD = 'GET';
    protected const PATH = '/systemdate.json';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),);
    protected const DYNAMIC_PATH = false;
}
