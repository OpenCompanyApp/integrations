<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * Delete a webhook.
 */
class AircallDeleteWebhook extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_delete_webhook';
    protected const TOOL_DESCRIPTION = 'Delete a webhook.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/webhooks/{webhook_id}';
    protected const PATH_KEYS = array (  0 => 'webhook_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'webhook_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Aircall resource ID for webhook id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),);
    protected const DYNAMIC_PATH = false;
}
