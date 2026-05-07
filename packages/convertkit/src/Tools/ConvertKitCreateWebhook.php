<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

/**
 * Create a subscriber event webhook.
 */
class ConvertKitCreateWebhook extends AbstractConvertKitEndpointTool
{
    protected const TOOL_NAME = 'convertkit_create_webhook';
    protected const TOOL_DESCRIPTION = 'Create a subscriber event webhook.';
    protected const METHOD = 'POST';
    protected const PATH = '/webhooks';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'event',  1 => 'target_url',);
    protected const PARAMETERS = array (  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'event' =>   array (    'type' => 'string',    'description' => 'Body field: event.',  ),  'target_url' =>   array (    'type' => 'string',    'description' => 'Body field: target url.',  ),);
    protected const DYNAMIC_PATH = false;
}
