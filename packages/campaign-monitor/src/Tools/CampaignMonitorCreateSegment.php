<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * Create a list segment.
 */
class CampaignMonitorCreateSegment extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_create_segment';
    protected const TOOL_DESCRIPTION = 'Create a list segment.';
    protected const METHOD = 'POST';
    protected const PATH = '/segments/{list_id}.json';
    protected const PATH_KEYS = array (  0 => 'list_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'Title',  1 => 'Rules',);
    protected const PARAMETERS = array (  'list_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Campaign Monitor resource ID for list id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'Title' =>   array (    'type' => 'string',    'description' => 'Body field: Title.',  ),  'Rules' =>   array (    'type' => 'array',    'description' => 'Body field: Rules.',  ),);
    protected const DYNAMIC_PATH = false;
}
