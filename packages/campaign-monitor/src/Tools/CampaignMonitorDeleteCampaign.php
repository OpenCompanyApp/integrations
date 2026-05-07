<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * Delete a draft or scheduled campaign.
 */
class CampaignMonitorDeleteCampaign extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_delete_campaign';
    protected const TOOL_DESCRIPTION = 'Delete a draft or scheduled campaign.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/campaigns/{campaign_id}.json';
    protected const PATH_KEYS = array (  0 => 'campaign_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'campaign_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Campaign Monitor resource ID for campaign id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),);
    protected const DYNAMIC_PATH = false;
}
