<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * Delete a client.
 */
class CampaignMonitorDeleteClient extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_delete_client';
    protected const TOOL_DESCRIPTION = 'Delete a client.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/clients/{client_id}.json';
    protected const PATH_KEYS = array (  0 => 'client_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'client_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Campaign Monitor resource ID for client id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),);
    protected const DYNAMIC_PATH = false;
}
