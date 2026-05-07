<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * Get transactional delivery and engagement statistics.
 */
class CampaignMonitorGetTransactionalStatistics extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_get_transactional_statistics';
    protected const TOOL_DESCRIPTION = 'Get transactional delivery and engagement statistics.';
    protected const METHOD = 'GET';
    protected const PATH = '/transactional/statistics';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array (  0 => 'group',  1 => 'smartEmailID',  2 => 'from',  3 => 'to',  4 => 'timezone',  5 => 'clientID',);
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),  'group' =>   array (    'type' => 'string',    'description' => 'Query parameter: group.',  ),  'smartEmailID' =>   array (    'type' => 'string',    'description' => 'Query parameter: smartEmailID.',  ),  'from' =>   array (    'type' => 'string',    'description' => 'Query parameter: from.',  ),  'to' =>   array (    'type' => 'string',    'description' => 'Query parameter: to.',  ),  'timezone' =>   array (    'type' => 'string',    'description' => 'Query parameter: timezone.',  ),  'clientID' =>   array (    'type' => 'string',    'description' => 'Query parameter: clientID.',  ),);
    protected const DYNAMIC_PATH = false;
}
