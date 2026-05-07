<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Create a Braze dashboard SCIM user.
 */
class BrazeCreateScimUser extends AbstractBrazeTool
{
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'SCIM user payload.',
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

    protected string $path = '/scim/v2/Users';

    protected string $toolName = 'braze_create_scim_user';

    protected string $toolDescription = 'Create a Braze dashboard SCIM user.';
}