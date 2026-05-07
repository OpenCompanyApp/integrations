<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * List supported time zones for client setup.
 */
class CampaignMonitorListTimeZones extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_list_time_zones';
    protected const TOOL_DESCRIPTION = 'List supported time zones for client setup.';
    protected const METHOD = 'GET';
    protected const PATH = '/timezones.json';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),);
    protected const DYNAMIC_PATH = false;
}
