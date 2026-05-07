<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Create a new user alias.
 */
class BrazeCreateUserAlias extends AbstractBrazeTool
{
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'User alias payload.',
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

    protected string $path = '/users/alias/new';

    protected string $toolName = 'braze_create_user_alias';

    protected string $toolDescription = 'Create a new user alias.';
}