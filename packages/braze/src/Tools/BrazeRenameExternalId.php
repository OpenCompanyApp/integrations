<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Rename a user external ID.
 */
class BrazeRenameExternalId extends AbstractBrazeTool
{
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'External ID rename payload.',
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

    protected string $path = '/users/external_ids/rename';

    protected string $toolName = 'braze_rename_external_id';

    protected string $toolDescription = 'Rename a user external ID.';
}