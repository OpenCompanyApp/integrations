<?php

namespace OpenCompany\Integrations\Airtable\Tools;

/**
 * Update a comment on an Airtable record.
 */
class AirtableUpdateComment extends AbstractAirtableTool
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
  'comment_id' =>
  array (
    'type' => 'string',
    'description' => 'Airtable comment ID.',
    'required' => true,
  ),
  'text' =>
  array (
    'type' => 'string',
    'description' => 'Updated comment text.',
  ),
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Additional comment payload.',
  ),
);

    protected array $required = array (
  0 => 'base_id',
  1 => 'table',
  2 => 'record_id',
  3 => 'comment_id',
);

    protected array $queryParams = array (
);

    protected array $bodyParams = array (
  'text' => 'text',
);

    protected string $method = 'PATCH';

    protected string $path = '/{base_id}/{table}/{record_id}/comments/{comment_id}';

    protected string $toolName = 'airtable_update_comment';

    protected string $toolDescription = 'Update a comment on an Airtable record.';
}
