<?php

namespace OpenCompany\Integrations\Airtable\Tools;

/**
 * Create a field in an Airtable table.
 */
class AirtableCreateField extends AbstractAirtableTool
{
    protected array $parameters = array (
  'base_id' =>
  array (
    'type' => 'string',
    'description' => 'Airtable base ID.',
    'required' => true,
  ),
  'table_id' =>
  array (
    'type' => 'string',
    'description' => 'Airtable table ID.',
    'required' => true,
  ),
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Field creation payload.',
  ),
);

    protected array $required = array (
  0 => 'base_id',
  1 => 'table_id',
);

    protected array $queryParams = array (
);

    protected array $bodyParams = array (
  0 => 'payload',
);

    protected string $method = 'POST';

    protected string $path = '/meta/bases/{base_id}/tables/{table_id}/fields';

    protected string $toolName = 'airtable_create_field';

    protected string $toolDescription = 'Create a field in an Airtable table.';
}
