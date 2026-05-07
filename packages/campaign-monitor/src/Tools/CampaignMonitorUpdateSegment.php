<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * Update a segment.
 */
class CampaignMonitorUpdateSegment extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_update_segment';
    protected const TOOL_DESCRIPTION = 'Update a segment.';
    protected const METHOD = 'PUT';
    protected const PATH = '/segments/{segment_id}.json';
    protected const PATH_KEYS = array (  0 => 'segment_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'Title',  1 => 'Rules',);
    protected const PARAMETERS = array (  'segment_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Campaign Monitor resource ID for segment id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'Title' =>   array (    'type' => 'string',    'description' => 'Body field: Title.',  ),  'Rules' =>   array (    'type' => 'array',    'description' => 'Body field: Rules.',  ),);
    protected const DYNAMIC_PATH = false;
}
