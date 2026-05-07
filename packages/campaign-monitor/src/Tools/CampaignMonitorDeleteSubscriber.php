<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * Delete a subscriber from a list.
 */
class CampaignMonitorDeleteSubscriber extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_delete_subscriber';
    protected const TOOL_DESCRIPTION = 'Delete a subscriber from a list.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/subscribers/{list_id}.json';
    protected const PATH_KEYS = array (  0 => 'list_id',);
    protected const QUERY_KEYS = array (  0 => 'email',);
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'list_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Campaign Monitor resource ID for list id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),  'email' =>   array (    'type' => 'string',    'description' => 'Query parameter: email.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),);
    protected const DYNAMIC_PATH = false;
}
