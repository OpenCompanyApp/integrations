<?php

namespace OpenCompany\Integrations\Airtable\Tools;

/**
 * Create a comment on an Airtable record.
 */
class AirtableCreateComment extends AbstractAirtableTool
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
  'text' =>
  array (
    'type' => 'string',
    'description' => 'Comment text.',
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
);

    protected array $queryParams = array (
);

    protected array $bodyParams = array (
  'text' => 'text',
);

    protected string $method = 'POST';

    protected string $path = '/{base_id}/{table}/{record_id}/comments';

    protected string $toolName = 'airtable_create_comment';

    protected string $toolDescription = 'Create a comment on an Airtable record.';
}
