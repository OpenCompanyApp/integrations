<?php

namespace OpenCompany\Integrations\Airtable\Tools;

/**
 * Get a single Airtable record.
 */
class AirtableGetRecord extends AbstractAirtableTool
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
);

    protected array $required = array (
  0 => 'base_id',
  1 => 'table',
  2 => 'record_id',
);

    protected array $queryParams = array (
  0 => 'cellFormat',
  1 => 'timeZone',
  2 => 'userLocale',
);

    protected array $bodyParams = array (
);

    protected string $method = 'GET';

    protected string $path = '/{base_id}/{table}/{record_id}';

    protected string $toolName = 'airtable_get_record';

    protected string $toolDescription = 'Get a single Airtable record.';
}
