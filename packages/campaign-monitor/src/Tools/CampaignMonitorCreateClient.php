<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * Create a client in the account.
 */
class CampaignMonitorCreateClient extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_create_client';
    protected const TOOL_DESCRIPTION = 'Create a client in the account.';
    protected const METHOD = 'POST';
    protected const PATH = '/clients.json';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'CompanyName',  1 => 'Country',  2 => 'TimeZone',);
    protected const PARAMETERS = array (  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'CompanyName' =>   array (    'type' => 'string',    'description' => 'Body field: CompanyName.',  ),  'Country' =>   array (    'type' => 'string',    'description' => 'Body field: Country.',  ),  'TimeZone' =>   array (    'type' => 'string',    'description' => 'Body field: TimeZone.',  ),);
    protected const DYNAMIC_PATH = false;
}
