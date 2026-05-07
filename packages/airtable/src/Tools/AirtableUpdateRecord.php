<?php

namespace OpenCompany\Integrations\Airtable\Tools;

/**
 * Update one Airtable record.
 */
class AirtableUpdateRecord extends AbstractAirtableTool
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
  'record_id' =>
  array (
    'type' => 'string',
    'description' => 'Airtable record ID.',
    'required' => true,
  ),
  'fields' =>
  array (
    'type' => 'object',
    'description' => 'Record fields.',
  ),
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Additional Airtable update options.',
  ),
);

    protected array $required = array (
  0 => 'base_id',
  1 => 'table',
  2 => 'record_id',
);

    protected array $queryParams = array (
);

    protected array $bodyParams = array (
  'fields' => 'fields',
);

    protected string $method = 'PATCH';

    protected string $path = '/{base_id}/{table}/{record_id}';

    protected string $toolName = 'airtable_update_record';

    protected string $toolDescription = 'Update one Airtable record.';
}
