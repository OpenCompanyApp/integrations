<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * Update client details.
 */
class CampaignMonitorUpdateClient extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_update_client';
    protected const TOOL_DESCRIPTION = 'Update client details.';
    protected const METHOD = 'PUT';
    protected const PATH = '/clients/{client_id}.json';
    protected const PATH_KEYS = array (  0 => 'client_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'CompanyName',  1 => 'Country',  2 => 'TimeZone',);
    protected const PARAMETERS = array (  'client_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Campaign Monitor resource ID for client id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'CompanyName' =>   array (    'type' => 'string',    'description' => 'Body field: CompanyName.',  ),  'Country' =>   array (    'type' => 'string',    'description' => 'Body field: Country.',  ),  'TimeZone' =>   array (    'type' => 'string',    'description' => 'Body field: TimeZone.',  ),);
    protected const DYNAMIC_PATH = false;
}
