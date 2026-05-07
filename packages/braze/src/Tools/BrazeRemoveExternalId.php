<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Remove user external IDs.
 */
class BrazeRemoveExternalId extends AbstractBrazeTool
{
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'External ID removal payload.',
  ),
);

    protected array $required = array (
);

    protected array $queryParams = array (
);

    protected array $bodyParams = array (
  0 => 'payload',
);

    protected string $method = 'POST';

    protected string $path = '/users/external_ids/remove';

    protected string $toolName = 'braze_remove_external_id';

    protected string $toolDescription = 'Remove user external IDs.';
}