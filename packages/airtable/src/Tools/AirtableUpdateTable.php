<?php

namespace OpenCompany\Integrations\Airtable\Tools;

/**
 * Update table metadata in an Airtable base.
 */
class AirtableUpdateTable extends AbstractAirtableTool
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
    'description' => 'Table update payload.',
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

    protected string $method = 'PATCH';

    protected string $path = '/meta/bases/{base_id}/tables/{table_id}';

    protected string $toolName = 'airtable_update_table';

    protected string $toolDescription = 'Update table metadata in an Airtable base.';
}
