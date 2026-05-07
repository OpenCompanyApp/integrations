<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Get Webhook Group.
 *
 * Maps to the official Brex endpoint get /v1/webhooks/groups/{id}.
 */
class BrexWebhooksGetWebhookGroup extends AbstractBrexTool
{
    protected const NAME = 'brex_webhooks_get_webhook_group';
    protected const DESCRIPTION = 'Get Webhook Group

Official Brex endpoint: GET /v1/webhooks/groups/{id}

Gets a webhook group.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Brex API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/webhooks/groups/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
