<?php

namespace OpenCompany\Integrations\Airtable\Tools;

/**
 * Create a table in an Airtable base.
 */
class AirtableCreateTable extends AbstractAirtableTool
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
    'description' => 'Table creation payload.',
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

    protected string $path = '/meta/bases/{base_id}/tables';

    protected string $toolName = 'airtable_create_table';

    protected string $toolDescription = 'Create a table in an Airtable base.';
}
