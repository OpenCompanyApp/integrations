<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * Get subscriber list details.
 */
class CampaignMonitorGetList extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_get_list';
    protected const TOOL_DESCRIPTION = 'Get subscriber list details.';
    protected const METHOD = 'GET';
    protected const PATH = '/lists/{list_id}.json';
    protected const PATH_KEYS = array (  0 => 'list_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'list_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Campaign Monitor resource ID for list id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),);
    protected const DYNAMIC_PATH = false;
}
