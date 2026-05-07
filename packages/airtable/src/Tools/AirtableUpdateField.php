<?php

namespace OpenCompany\Integrations\Airtable\Tools;

/**
 * Update field metadata in an Airtable table.
 */
class AirtableUpdateField extends AbstractAirtableTool
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
  'field_id' =>
  array (
    'type' => 'string',
    'description' => 'Airtable field ID.',
    'required' => true,
  ),
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Field update payload.',
  ),
);

    protected array $required = array (
  0 => 'base_id',
  1 => 'table_id',
  2 => 'field_id',
);

    protected array $queryParams = array (
);

    protected array $bodyParams = array (
  0 => 'payload',
);

    protected string $method = 'PATCH';

    protected string $path = '/meta/bases/{base_id}/tables/{table_id}/fields/{field_id}';

    protected string $toolName = 'airtable_update_field';

    protected string $toolDescription = 'Update field metadata in an Airtable table.';
}
