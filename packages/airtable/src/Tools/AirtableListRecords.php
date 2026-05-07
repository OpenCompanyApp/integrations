<?php

namespace OpenCompany\Integrations\Airtable\Tools;

/**
 * List records from an Airtable table.
 */
class AirtableListRecords extends AbstractAirtableTool
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
  'view' =>
  array (
    'type' => 'string',
    'description' => 'View ID or name.',
  ),
  'filterByFormula' =>
  array (
    'type' => 'string',
    'description' => 'Airtable formula filter.',
  ),
  'maxRecords' =>
  array (
    'type' => 'integer',
    'description' => 'Maximum records to return.',
  ),
  'pageSize' =>
  array (
    'type' => 'integer',
    'description' => 'Page size, up to 100.',
  ),
  'offset' =>
  array (
    'type' => 'integer',
    'description' => 'Pagination offset.',
  ),
  'cellFormat' =>
  array (
    'type' => 'string',
    'description' => 'Cell format.',
  ),
  'timeZone' =>
  array (
    'type' => 'string',
    'description' => 'Time zone for string cell format.',
  ),
  'userLocale' =>
  array (
    'type' => 'string',
    'description' => 'User locale for string cell format.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'description' => 'Additional query parameters such as fields[] or sort[].',
  ),
);

    protected array $required = array (
  0 => 'base_id',
  1 => 'table',
);

    protected array $queryParams = array (
  0 => 'view',
  1 => 'filterByFormula',
  2 => 'maxRecords',
  3 => 'pageSize',
  4 => 'offset',
  5 => 'cellFormat',
  6 => 'timeZone',
  7 => 'userLocale',
  8 => 'query',
);

    protected array $bodyParams = array (
);

    protected string $method = 'GET';

    protected string $path = '/{base_id}/{table}';

    protected string $toolName = 'airtable_list_records';

    protected string $toolDescription = 'List records from an Airtable table.';
}
