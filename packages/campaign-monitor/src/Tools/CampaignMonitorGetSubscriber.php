<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * Get subscriber details by email address.
 */
class CampaignMonitorGetSubscriber extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_get_subscriber';
    protected const TOOL_DESCRIPTION = 'Get subscriber details by email address.';
    protected const METHOD = 'GET';
    protected const PATH = '/subscribers/{list_id}.json';
    protected const PATH_KEYS = array (  0 => 'list_id',);
    protected const QUERY_KEYS = array (  0 => 'email',  1 => 'includetrackingpreference',);
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'list_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Campaign Monitor resource ID for list id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),  'email' =>   array (    'type' => 'string',    'description' => 'Query parameter: email.',  ),  'includetrackingpreference' =>   array (    'type' => 'string',    'description' => 'Query parameter: includetrackingpreference.',  ),);
    protected const DYNAMIC_PATH = false;
}
