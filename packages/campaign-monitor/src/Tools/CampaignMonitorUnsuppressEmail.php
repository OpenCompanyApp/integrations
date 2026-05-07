<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * Remove an email address from a client suppression list.
 */
class CampaignMonitorUnsuppressEmail extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_unsuppress_email';
    protected const TOOL_DESCRIPTION = 'Remove an email address from a client suppression list.';
    protected const METHOD = 'PUT';
    protected const PATH = '/clients/{client_id}/unsuppress.json';
    protected const PATH_KEYS = array (  0 => 'client_id',);
    protected const QUERY_KEYS = array (  0 => 'email',);
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'client_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Campaign Monitor resource ID for client id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),  'email' =>   array (    'type' => 'string',    'description' => 'Query parameter: email.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),);
    protected const DYNAMIC_PATH = false;
}
