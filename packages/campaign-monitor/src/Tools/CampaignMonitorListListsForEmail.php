<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * List subscriber lists a specific email belongs to.
 */
class CampaignMonitorListListsForEmail extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_list_lists_for_email';
    protected const TOOL_DESCRIPTION = 'List subscriber lists a specific email belongs to.';
    protected const METHOD = 'GET';
    protected const PATH = '/clients/{client_id}/listsforemail.json';
    protected const PATH_KEYS = array (  0 => 'client_id',);
    protected const QUERY_KEYS = array (  0 => 'email',);
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'client_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Campaign Monitor resource ID for client id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),  'email' =>   array (    'type' => 'string',    'description' => 'Query parameter: email.',  ),);
    protected const DYNAMIC_PATH = false;
}
