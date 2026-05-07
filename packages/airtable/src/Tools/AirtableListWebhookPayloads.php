<?php

namespace OpenCompany\Integrations\Airtable\Tools;

/**
 * List webhook payloads for an Airtable webhook.
 */
class AirtableListWebhookPayloads extends AbstractAirtableTool
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
  'cursor' =>
  array (
    'type' => 'string',
    'description' => 'Payload cursor.',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'description' => 'Maximum payloads to return.',
  ),
);

    protected array $required = array (
  0 => 'base_id',
  1 => 'webhook_id',
);

    protected array $queryParams = array (
  0 => 'cursor',
  1 => 'limit',
);

    protected array $bodyParams = array (
);

    protected string $method = 'GET';

    protected string $path = '/bases/{base_id}/webhooks/{webhook_id}/payloads';

    protected string $toolName = 'airtable_list_webhook_payloads';

    protected string $toolDescription = 'List webhook payloads for an Airtable webhook.';
}
