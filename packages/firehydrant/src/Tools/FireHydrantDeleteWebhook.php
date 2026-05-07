<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Delete a webhook.
 *
 * Maps to the official FireHydrant endpoint delete /v1/webhooks/{webhook_id}.
 */
class FireHydrantDeleteWebhook extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_webhook';
    protected const DESCRIPTION = 'Delete a webhook

Official FireHydrant endpoint: DELETE /v1/webhooks/{webhook_id}

Delete a specific webhook';
    protected const PARAMETERS = array (
  'webhook_id' =>
  array (
    'type' => 'string',
    'description' => 'webhook_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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
