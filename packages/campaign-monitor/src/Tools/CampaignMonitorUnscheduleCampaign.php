<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * Unschedule a campaign and move it back to drafts.
 */
class CampaignMonitorUnscheduleCampaign extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_unschedule_campaign';
    protected const TOOL_DESCRIPTION = 'Unschedule a campaign and move it back to drafts.';
    protected const METHOD = 'POST';
    protected const PATH = '/campaigns/{campaign_id}/unschedule.json';
    protected const PATH_KEYS = array (  0 => 'campaign_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'campaign_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Campaign Monitor resource ID for campaign id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),);
    protected const DYNAMIC_PATH = false;
}
