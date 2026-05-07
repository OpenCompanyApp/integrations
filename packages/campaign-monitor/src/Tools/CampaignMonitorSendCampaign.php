<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * Send or schedule a campaign.
 */
class CampaignMonitorSendCampaign extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_send_campaign';
    protected const TOOL_DESCRIPTION = 'Send or schedule a campaign.';
    protected const METHOD = 'POST';
    protected const PATH = '/campaigns/{campaign_id}/send.json';
    protected const PATH_KEYS = array (  0 => 'campaign_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'ConfirmationEmail',  1 => 'SendDate',);
    protected const PARAMETERS = array (  'campaign_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Campaign Monitor resource ID for campaign id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'ConfirmationEmail' =>   array (    'type' => 'string',    'description' => 'Body field: ConfirmationEmail.',  ),  'SendDate' =>   array (    'type' => 'string',    'description' => 'Body field: SendDate.',  ),);
    protected const DYNAMIC_PATH = false;
}
