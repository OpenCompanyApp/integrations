<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * Send a transactional smart email.
 */
class CampaignMonitorSendSmartEmail extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_send_smart_email';
    protected const TOOL_DESCRIPTION = 'Send a transactional smart email.';
    protected const METHOD = 'POST';
    protected const PATH = '/transactional/smartEmail/{smart_email_id}/send';
    protected const PATH_KEYS = array (  0 => 'smart_email_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'To',  1 => 'CC',  2 => 'BCC',  3 => 'Attachments',  4 => 'Data',  5 => 'AddRecipientsToList',);
    protected const PARAMETERS = array (  'smart_email_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Campaign Monitor resource ID for smart email id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'To' =>   array (    'type' => 'array',    'description' => 'Body field: To.',  ),  'CC' =>   array (    'type' => 'array',    'description' => 'Body field: CC.',  ),  'BCC' =>   array (    'type' => 'array',    'description' => 'Body field: BCC.',  ),  'Attachments' =>   array (    'type' => 'array',    'description' => 'Body field: Attachments.',  ),  'Data' =>   array (    'type' => 'array',    'description' => 'Body field: Data.',  ),  'AddRecipientsToList' =>   array (    'type' => 'string',    'description' => 'Body field: AddRecipientsToList.',  ),);
    protected const DYNAMIC_PATH = false;
}
