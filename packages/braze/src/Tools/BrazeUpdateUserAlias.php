<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Update a user alias.
 */
class BrazeUpdateUserAlias extends AbstractBrazeTool
{
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'User alias update payload.',
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

    protected string $path = '/users/alias/update';

    protected string $toolName = 'braze_update_user_alias';

    protected string $toolDescription = 'Update a user alias.';
}