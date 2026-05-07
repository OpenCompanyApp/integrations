<?php

namespace OpenCompany\Integrations\Airtable\Tools;

/**
 * Create an Airtable webhook for a base.
 */
class AirtableCreateWebhook extends AbstractAirtableTool
{
    protected array $parameters = array (
  'base_id' =>
  array (
    'type' => 'string',
    'description' => 'Airtable base ID.',
    'required' => true,
  ),
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Webhook creation payload.',
  ),
);

    protected array $required = array (
  0 => 'base_id',
);

    protected array $queryParams = array (
);

    protected array $bodyParams = array (
  0 => 'payload',
);

    protected string $method = 'POST';

    protected string $path = '/bases/{base_id}/webhooks';

    protected string $toolName = 'airtable_create_webhook';

    protected string $toolDescription = 'Create an Airtable webhook for a base.';
}
