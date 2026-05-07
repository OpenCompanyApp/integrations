<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Delete Braze users.
 */
class BrazeDeleteUsers extends AbstractBrazeTool
{
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'User delete payload.',
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

    protected string $path = '/users/delete';

    protected string $toolName = 'braze_delete_users';

    protected string $toolDescription = 'Delete Braze users.';
}