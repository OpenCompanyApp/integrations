<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update a webhook.
 *
 * Maps to the official FireHydrant endpoint patch /v1/webhooks/{webhook_id}.
 */
class FireHydrantUpdateWebhook extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_webhook';
    protected const DESCRIPTION = 'Update a webhook

Official FireHydrant endpoint: PATCH /v1/webhooks/{webhook_id}

Update a specific webhook';
    protected const PARAMETERS = array (
  'webhook_id' =>
  array (
    'type' => 'string',
    'description' => 'webhook_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/webhooks/{webhook_id}';
    protected const PATH_PARAMS = array (
  'webhook_id' => 'webhook_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
