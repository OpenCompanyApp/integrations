<?php

namespace OpenCompany\Integrations\Airtable\Tools;

/**
 * List views by reading Airtable base schema metadata.
 */
class AirtableListViews extends AbstractAirtableTool
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

    protected string $toolName = 'airtable_list_views';

    protected string $toolDescription = 'List views by reading Airtable base schema metadata.';
}
