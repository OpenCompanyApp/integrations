<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * Retrieve a webhook.
 */
class AircallGetWebhook extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_get_webhook';
    protected const TOOL_DESCRIPTION = 'Retrieve a webhook.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/webhooks/{webhook_id}';
    protected const PATH_KEYS = array (  0 => 'webhook_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'webhook_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Aircall resource ID for webhook id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),);
    protected const DYNAMIC_PATH = false;
}
