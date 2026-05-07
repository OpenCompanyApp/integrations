<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * Deactivate a list webhook.
 */
class CampaignMonitorDeactivateWebhook extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_deactivate_webhook';
    protected const TOOL_DESCRIPTION = 'Deactivate a list webhook.';
    protected const METHOD = 'PUT';
    protected const PATH = '/lists/{list_id}/webhooks/{webhook_id}/deactivate.json';
    protected const PATH_KEYS = array (  0 => 'list_id',  1 => 'webhook_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'list_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Campaign Monitor resource ID for list id.',  ),  'webhook_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Campaign Monitor resource ID for webhook id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),);
    protected const DYNAMIC_PATH = false;
}
