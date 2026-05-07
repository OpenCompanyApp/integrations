<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * List clients visible to the account.
 */
class CampaignMonitorListClients extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_list_clients';
    protected const TOOL_DESCRIPTION = 'List clients visible to the account.';
    protected const METHOD = 'GET';
    protected const PATH = '/clients.json';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),);
    protected const DYNAMIC_PATH = false;
}
