<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * Update a webhook.
 */
class AircallUpdateWebhook extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_update_webhook';
    protected const TOOL_DESCRIPTION = 'Update a webhook.';
    protected const METHOD = 'PUT';
    protected const PATH = '/v1/webhooks/{webhook_id}';
    protected const PATH_KEYS = array (  0 => 'webhook_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'url',  1 => 'events',  2 => 'name',  3 => 'token',);
    protected const PARAMETERS = array (  'webhook_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Aircall resource ID for webhook id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'url' =>   array (    'type' => 'string',    'description' => 'Body field: url.',  ),  'events' =>   array (    'type' => 'array',    'description' => 'Body field: events.',  ),  'name' =>   array (    'type' => 'string',    'description' => 'Body field: name.',  ),  'token' =>   array (    'type' => 'string',    'description' => 'Body field: token.',  ),);
    protected const DYNAMIC_PATH = false;
}
