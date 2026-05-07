<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * List active subscribers in a segment.
 */
class CampaignMonitorListSegmentSubscribers extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_list_segment_subscribers';
    protected const TOOL_DESCRIPTION = 'List active subscribers in a segment.';
    protected const METHOD = 'GET';
    protected const PATH = '/segments/{segment_id}/active.json';
    protected const PATH_KEYS = array (  0 => 'segment_id',);
    protected const QUERY_KEYS = array (  0 => 'date',  1 => 'page',  2 => 'pagesize',  3 => 'orderfield',  4 => 'orderdirection',);
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'segment_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Campaign Monitor resource ID for segment id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),  'date' =>   array (    'type' => 'string',    'description' => 'Query parameter: date.',  ),  'page' =>   array (    'type' => 'string',    'description' => 'Query parameter: page.',  ),  'pagesize' =>   array (    'type' => 'string',    'description' => 'Query parameter: pagesize.',  ),  'orderfield' =>   array (    'type' => 'string',    'description' => 'Query parameter: orderfield.',  ),  'orderdirection' =>   array (    'type' => 'string',    'description' => 'Query parameter: orderdirection.',  ),);
    protected const DYNAMIC_PATH = false;
}
