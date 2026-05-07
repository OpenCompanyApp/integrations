<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * Create a webhook for a subscriber list.
 */
class CampaignMonitorCreateWebhook extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_create_webhook';
    protected const TOOL_DESCRIPTION = 'Create a webhook for a subscriber list.';
    protected const METHOD = 'POST';
    protected const PATH = '/lists/{list_id}/webhooks.json';
    protected const PATH_KEYS = array (  0 => 'list_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'Events',  1 => 'Url',  2 => 'PayloadFormat',);
    protected const PARAMETERS = array (  'list_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Campaign Monitor resource ID for list id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'Events' =>   array (    'type' => 'array',    'description' => 'Body field: Events.',  ),  'Url' =>   array (    'type' => 'string',    'description' => 'Body field: Url.',  ),  'PayloadFormat' =>   array (    'type' => 'string',    'description' => 'Body field: PayloadFormat.',  ),);
    protected const DYNAMIC_PATH = false;
}
