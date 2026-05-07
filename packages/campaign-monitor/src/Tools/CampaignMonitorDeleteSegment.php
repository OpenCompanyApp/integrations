<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * Delete a segment.
 */
class CampaignMonitorDeleteSegment extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_delete_segment';
    protected const TOOL_DESCRIPTION = 'Delete a segment.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/segments/{segment_id}.json';
    protected const PATH_KEYS = array (  0 => 'segment_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'segment_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Campaign Monitor resource ID for segment id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),);
    protected const DYNAMIC_PATH = false;
}
