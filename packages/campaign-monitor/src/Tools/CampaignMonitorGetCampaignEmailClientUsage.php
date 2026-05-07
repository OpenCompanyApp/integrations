<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * List email clients used to open a campaign.
 */
class CampaignMonitorGetCampaignEmailClientUsage extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_get_campaign_email_client_usage';
    protected const TOOL_DESCRIPTION = 'List email clients used to open a campaign.';
    protected const METHOD = 'GET';
    protected const PATH = '/campaigns/{campaign_id}/emailclientusage.json';
    protected const PATH_KEYS = array (  0 => 'campaign_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'campaign_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Campaign Monitor resource ID for campaign id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),);
    protected const DYNAMIC_PATH = false;
}
