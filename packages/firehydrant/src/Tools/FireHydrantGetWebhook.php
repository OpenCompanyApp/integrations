<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get a webhook.
 *
 * Maps to the official FireHydrant endpoint get /v1/webhooks/{webhook_id}.
 */
class FireHydrantGetWebhook extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_webhook';
    protected const DESCRIPTION = 'Get a webhook

Official FireHydrant endpoint: GET /v1/webhooks/{webhook_id}

Retrieve a specific webhook';
    protected const PARAMETERS = array (
  'webhook_id' =>
  array (
    'type' => 'string',
    'description' => 'webhook_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/webhooks/{webhook_id}';
    protected const PATH_PARAMS = array (
  'webhook_id' => 'webhook_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
