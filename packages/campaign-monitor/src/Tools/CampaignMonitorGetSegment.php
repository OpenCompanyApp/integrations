<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * Get segment details.
 */
class CampaignMonitorGetSegment extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_get_segment';
    protected const TOOL_DESCRIPTION = 'Get segment details.';
    protected const METHOD = 'GET';
    protected const PATH = '/segments/{segment_id}.json';
    protected const PATH_KEYS = array (  0 => 'segment_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'segment_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Campaign Monitor resource ID for segment id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),);
    protected const DYNAMIC_PATH = false;
}
