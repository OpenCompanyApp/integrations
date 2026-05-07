<?php

namespace OpenCompany\Integrations\Airtable\Tools;

/**
 * Delete one Airtable record.
 */
class AirtableDeleteRecord extends AbstractAirtableTool
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
);

    protected array $required = array (
  0 => 'base_id',
  1 => 'table',
  2 => 'record_id',
);

    protected array $queryParams = array (
);

    protected array $bodyParams = array (
);

    protected string $method = 'DELETE';

    protected string $path = '/{base_id}/{table}/{record_id}';

    protected string $toolName = 'airtable_delete_record';

    protected string $toolDescription = 'Delete one Airtable record.';
}
