<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * Send a test payload to a webhook.
 */
class CampaignMonitorTestWebhook extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_test_webhook';
    protected const TOOL_DESCRIPTION = 'Send a test payload to a webhook.';
    protected const METHOD = 'GET';
    protected const PATH = '/lists/{list_id}/webhooks/{webhook_id}/test.json';
    protected const PATH_KEYS = array (  0 => 'list_id',  1 => 'webhook_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'list_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Campaign Monitor resource ID for list id.',  ),  'webhook_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Campaign Monitor resource ID for webhook id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),);
    protected const DYNAMIC_PATH = false;
}
