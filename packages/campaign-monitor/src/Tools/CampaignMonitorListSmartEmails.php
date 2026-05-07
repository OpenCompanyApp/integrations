<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * List transactional smart emails.
 */
class CampaignMonitorListSmartEmails extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_list_smart_emails';
    protected const TOOL_DESCRIPTION = 'List transactional smart emails.';
    protected const METHOD = 'GET';
    protected const PATH = '/transactional/smartEmail';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array (  0 => 'status',  1 => 'clientID',);
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),  'status' =>   array (    'type' => 'string',    'description' => 'Query parameter: status.',  ),  'clientID' =>   array (    'type' => 'string',    'description' => 'Query parameter: clientID.',  ),);
    protected const DYNAMIC_PATH = false;
}
