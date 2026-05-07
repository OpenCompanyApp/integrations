<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * List transactional classic email groups.
 */
class CampaignMonitorListClassicEmailGroups extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_list_classic_email_groups';
    protected const TOOL_DESCRIPTION = 'List transactional classic email groups.';
    protected const METHOD = 'GET';
    protected const PATH = '/transactional/classicEmail/groups';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array (  0 => 'clientID',);
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),  'clientID' =>   array (    'type' => 'string',    'description' => 'Query parameter: clientID.',  ),);
    protected const DYNAMIC_PATH = false;
}
