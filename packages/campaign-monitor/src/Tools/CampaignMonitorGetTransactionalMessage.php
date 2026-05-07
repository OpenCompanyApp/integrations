<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * Get transactional message details.
 */
class CampaignMonitorGetTransactionalMessage extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_get_transactional_message';
    protected const TOOL_DESCRIPTION = 'Get transactional message details.';
    protected const METHOD = 'GET';
    protected const PATH = '/transactional/messages/{message_id}';
    protected const PATH_KEYS = array (  0 => 'message_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'message_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Campaign Monitor resource ID for message id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),);
    protected const DYNAMIC_PATH = false;
}
