<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * List transactional message timeline entries.
 */
class CampaignMonitorListTransactionalMessages extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_list_transactional_messages';
    protected const TOOL_DESCRIPTION = 'List transactional message timeline entries.';
    protected const METHOD = 'GET';
    protected const PATH = '/transactional/messages';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array (  0 => 'group',  1 => 'smartEmailID',  2 => 'sentBeforeID',  3 => 'sentAfterID',  4 => 'count',  5 => 'status',  6 => 'clientID',);
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),  'group' =>   array (    'type' => 'string',    'description' => 'Query parameter: group.',  ),  'smartEmailID' =>   array (    'type' => 'string',    'description' => 'Query parameter: smartEmailID.',  ),  'sentBeforeID' =>   array (    'type' => 'string',    'description' => 'Query parameter: sentBeforeID.',  ),  'sentAfterID' =>   array (    'type' => 'string',    'description' => 'Query parameter: sentAfterID.',  ),  'count' =>   array (    'type' => 'string',    'description' => 'Query parameter: count.',  ),  'status' =>   array (    'type' => 'string',    'description' => 'Query parameter: status.',  ),  'clientID' =>   array (    'type' => 'string',    'description' => 'Query parameter: clientID.',  ),);
    protected const DYNAMIC_PATH = false;
}
