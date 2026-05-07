<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * Get transactional smart email details.
 */
class CampaignMonitorGetSmartEmail extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_get_smart_email';
    protected const TOOL_DESCRIPTION = 'Get transactional smart email details.';
    protected const METHOD = 'GET';
    protected const PATH = '/transactional/smartEmail/{smart_email_id}';
    protected const PATH_KEYS = array (  0 => 'smart_email_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'smart_email_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Campaign Monitor resource ID for smart email id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),);
    protected const DYNAMIC_PATH = false;
}
