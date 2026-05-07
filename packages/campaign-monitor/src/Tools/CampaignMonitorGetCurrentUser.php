<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * Get the account primary contact.
 */
class CampaignMonitorGetCurrentUser extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_get_current_user';
    protected const TOOL_DESCRIPTION = 'Get the account primary contact.';
    protected const METHOD = 'GET';
    protected const PATH = '/primarycontact.json';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),);
    protected const DYNAMIC_PATH = false;
}
