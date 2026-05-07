<?php

namespace OpenCompany\Integrations\Airtable\Tools;

/**
 * Get table, field, and view schema metadata for a base.
 */
class AirtableGetBaseSchema extends AbstractAirtableTool
{
    protected array $parameters = array (
  'base_id' =>
  array (
    'type' => 'string',
    'description' => 'Airtable base ID.',
    'required' => true,
  ),
);

    protected array $required = array (
  0 => 'base_id',
);

    protected array $queryParams = array (
);

    protected array $bodyParams = array (
);

    protected string $method = 'GET';

    protected string $path = '/meta/bases/{base_id}/tables';

    protected string $toolName = 'airtable_get_base_schema';

    protected string $toolDescription = 'Get table, field, and view schema metadata for a base.';
}
