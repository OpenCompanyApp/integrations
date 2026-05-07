<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Delete Webhook Group.
 *
 * Maps to the official Brex endpoint delete /v1/webhooks/groups/{id}.
 */
class BrexWebhooksDeleteWebhookGroup extends AbstractBrexTool
{
    protected const NAME = 'brex_webhooks_delete_webhook_group';
    protected const DESCRIPTION = 'Delete Webhook Group

Official Brex endpoint: DELETE /v1/webhooks/groups/{id}

Deletes a webhook group and all its members.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Brex API operation.',
  ),
);
    protected const METHOD = 'delete';
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
