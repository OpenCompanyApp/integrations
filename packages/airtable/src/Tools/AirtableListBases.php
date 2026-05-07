<?php

namespace OpenCompany\Integrations\Airtable\Tools;

/**
 * List Airtable bases accessible to the token.
 */
class AirtableListBases extends AbstractAirtableTool
{
    protected array $parameters = array (
  'offset' =>
  array (
    'type' => 'integer',
    'description' => 'Pagination offset.',
  ),
);

    protected array $required = array (
);

    protected array $queryParams = array (
  0 => 'offset',
);

    protected array $bodyParams = array (
);

    protected string $method = 'GET';

    protected string $path = '/meta/bases';

    protected string $toolName = 'airtable_list_bases';

    protected string $toolDescription = 'List Airtable bases accessible to the token.';
}
