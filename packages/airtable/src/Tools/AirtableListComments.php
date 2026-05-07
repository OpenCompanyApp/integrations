<?php

namespace OpenCompany\Integrations\Airtable\Tools;

/**
 * List comments for an Airtable record.
 */
class AirtableListComments extends AbstractAirtableTool
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
  'offset' =>
  array (
    'type' => 'integer',
    'description' => 'Pagination offset.',
  ),
);

    protected array $required = array (
  0 => 'base_id',
  1 => 'table',
  2 => 'record_id',
);

    protected array $queryParams = array (
  0 => 'offset',
);

    protected array $bodyParams = array (
);

    protected string $method = 'GET';

    protected string $path = '/{base_id}/{table}/{record_id}/comments';

    protected string $toolName = 'airtable_list_comments';

    protected string $toolDescription = 'List comments for an Airtable record.';
}
