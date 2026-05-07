<?php

namespace OpenCompany\Integrations\Airtable\Tools;

/**
 * Delete multiple Airtable records using records[] query parameters.
 */
class AirtableDeleteRecords extends AbstractAirtableTool
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
  'query' =>
  array (
    'type' => 'object',
    'description' => 'Query parameters, usually records[] IDs.',
  ),
);

    protected array $required = array (
  0 => 'base_id',
  1 => 'table',
);

    protected array $queryParams = array (
  0 => 'query',
);

    protected array $bodyParams = array (
);

    protected string $method = 'DELETE';

    protected string $path = '/{base_id}/{table}';

    protected string $toolName = 'airtable_delete_records';

    protected string $toolDescription = 'Delete multiple Airtable records using records[] query parameters.';
}
