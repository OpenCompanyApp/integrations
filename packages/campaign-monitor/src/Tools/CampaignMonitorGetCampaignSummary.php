<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * Get campaign summary reporting.
 */
class CampaignMonitorGetCampaignSummary extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_get_campaign_summary';
    protected const TOOL_DESCRIPTION = 'Get campaign summary reporting.';
    protected const METHOD = 'GET';
    protected const PATH = '/campaigns/{campaign_id}/summary.json';
    protected const PATH_KEYS = array (  0 => 'campaign_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'campaign_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Campaign Monitor resource ID for campaign id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),);
    protected const DYNAMIC_PATH = false;
}
