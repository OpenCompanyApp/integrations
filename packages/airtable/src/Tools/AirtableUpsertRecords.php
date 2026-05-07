<?php

namespace OpenCompany\Integrations\Airtable\Tools;

/**
 * Create or update records using Airtable performUpsert.
 */
class AirtableUpsertRecords extends AbstractAirtableTool
{
    protected array $parameters = array (
  'base_id' =>
  array (
    'type' => 'string',
    'description' => 'Airtable base ID.',
    'required' => true,
  ),
  'table' =>
  array (
    'type' => 'string',
    'description' => 'Table ID or name.',
    'required' => true,
  ),
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Payload containing records and performUpsert options.',
  ),
);

    protected array $required = array (
  0 => 'base_id',
  1 => 'table',
);

    protected array $queryParams = array (
);

    protected array $bodyParams = array (
  0 => 'payload',
);

    protected string $method = 'PATCH';

    protected string $path = '/{base_id}/{table}';

    protected string $toolName = 'airtable_upsert_records';

    protected string $toolDescription = 'Create or update records using Airtable performUpsert.';
}
