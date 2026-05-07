<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * Resend a transactional message.
 */
class CampaignMonitorResendTransactionalMessage extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_resend_transactional_message';
    protected const TOOL_DESCRIPTION = 'Resend a transactional message.';
    protected const METHOD = 'POST';
    protected const PATH = '/transactional/messages/{message_id}/resend';
    protected const PATH_KEYS = array (  0 => 'message_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'message_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Campaign Monitor resource ID for message id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),);
    protected const DYNAMIC_PATH = false;
}
