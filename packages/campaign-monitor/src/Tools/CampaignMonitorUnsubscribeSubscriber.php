<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * Unsubscribe an email address from a list.
 */
class CampaignMonitorUnsubscribeSubscriber extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_unsubscribe_subscriber';
    protected const TOOL_DESCRIPTION = 'Unsubscribe an email address from a list.';
    protected const METHOD = 'POST';
    protected const PATH = '/subscribers/{list_id}/unsubscribe.json';
    protected const PATH_KEYS = array (  0 => 'list_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'EmailAddress',);
    protected const PARAMETERS = array (  'list_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Campaign Monitor resource ID for list id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'EmailAddress' =>   array (    'type' => 'string',    'description' => 'Body field: EmailAddress.',  ),);
    protected const DYNAMIC_PATH = false;
}
