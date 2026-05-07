<?php

namespace OpenCompany\Integrations\Airtable\Tools;

/**
 * List Airtable webhooks for a base.
 */
class AirtableListWebhooks extends AbstractAirtableTool
{
    protected array $parameters = array (
  'base_id' =>
  array (
    'type' => 'string',
    'description' => 'Airtable base ID.',
    'required' => true,
  ),
);

    protected array $required = array (
  0 => 'base_id',
);

    protected array $queryParams = array (
);

    protected array $bodyParams = array (
);

    protected string $method = 'GET';

    protected string $path = '/bases/{base_id}/webhooks';

    protected string $toolName = 'airtable_list_webhooks';

    protected string $toolDescription = 'List Airtable webhooks for a base.';
}
