<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * Create a webhook.
 */
class AircallCreateWebhook extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_create_webhook';
    protected const TOOL_DESCRIPTION = 'Create a webhook.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/webhooks';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'url',  1 => 'events',  2 => 'name',  3 => 'token',);
    protected const PARAMETERS = array (  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'url' =>   array (    'type' => 'string',    'description' => 'Body field: url.',  ),  'events' =>   array (    'type' => 'array',    'description' => 'Body field: events.',  ),  'name' =>   array (    'type' => 'string',    'description' => 'Body field: name.',  ),  'token' =>   array (    'type' => 'string',    'description' => 'Body field: token.',  ),);
    protected const DYNAMIC_PATH = false;
}
