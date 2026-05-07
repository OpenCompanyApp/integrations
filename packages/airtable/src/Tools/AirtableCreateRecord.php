<?php

namespace OpenCompany\Integrations\Airtable\Tools;

/**
 * Create one Airtable record.
 */
class AirtableCreateRecord extends AbstractAirtableTool
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
  'fields' =>
  array (
    'type' => 'object',
    'description' => 'Record fields.',
  ),
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Additional Airtable create options.',
  ),
);

    protected array $required = array (
  0 => 'base_id',
  1 => 'table',
);

    protected array $queryParams = array (
);

    protected array $bodyParams = array (
  'fields' => 'fields',
);

    protected string $method = 'POST';

    protected string $path = '/{base_id}/{table}';

    protected string $toolName = 'airtable_create_record';

    protected string $toolDescription = 'Create one Airtable record.';
}
