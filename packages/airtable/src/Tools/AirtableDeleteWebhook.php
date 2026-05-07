<?php

namespace OpenCompany\Integrations\Airtable\Tools;

/**
 * Delete an Airtable webhook.
 */
class AirtableDeleteWebhook extends AbstractAirtableTool
{
    protected array $parameters = array (
  'base_id' =>
  array (
    'type' => 'string',
    'description' => 'Airtable base ID.',
    'required' => true,
  ),
  'webhook_id' =>
  array (
    'type' => 'string',
    'description' => 'Webhook ID.',
    'required' => true,
  ),
);

    protected array $required = array (
  0 => 'base_id',
  1 => 'webhook_id',
);

    protected array $queryParams = array (
);

    protected array $bodyParams = array (
);

    protected string $method = 'DELETE';

    protected string $path = '/bases/{base_id}/webhooks/{webhook_id}';

    protected string $toolName = 'airtable_delete_webhook';

    protected string $toolDescription = 'Delete an Airtable webhook.';
}
