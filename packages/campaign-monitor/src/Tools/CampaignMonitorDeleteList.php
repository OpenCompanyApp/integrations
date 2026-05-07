<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * Delete a subscriber list.
 */
class CampaignMonitorDeleteList extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_delete_list';
    protected const TOOL_DESCRIPTION = 'Delete a subscriber list.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/lists/{list_id}.json';
    protected const PATH_KEYS = array (  0 => 'list_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'list_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Campaign Monitor resource ID for list id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),);
    protected const DYNAMIC_PATH = false;
}
