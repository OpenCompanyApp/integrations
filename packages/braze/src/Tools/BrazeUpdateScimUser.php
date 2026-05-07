<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Update a Braze dashboard SCIM user.
 */
class BrazeUpdateScimUser extends AbstractBrazeTool
{
    protected array $parameters = array (
  'user_id' =>
  array (
    'type' => 'string',
    'description' => 'SCIM user ID.',
    'required' => true,
  ),
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'SCIM user payload.',
  ),
);

    protected array $required = array (
  0 => 'user_id',
);

    protected array $queryParams = array (
);

    protected array $bodyParams = array (
  0 => 'payload',
);

    protected string $method = 'PUT';

    protected string $path = '/scim/v2/Users/{user_id}';

    protected string $toolName = 'braze_update_scim_user';

    protected string $toolDescription = 'Update a Braze dashboard SCIM user.';
}