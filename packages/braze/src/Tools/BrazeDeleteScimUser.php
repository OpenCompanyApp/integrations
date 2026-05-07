<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Remove a Braze dashboard SCIM user.
 */
class BrazeDeleteScimUser extends AbstractBrazeTool
{
    protected array $parameters = array (
  'user_id' =>
  array (
    'type' => 'string',
    'description' => 'SCIM user ID.',
    'required' => true,
  ),
);

    protected array $required = array (
  0 => 'user_id',
);

    protected array $queryParams = array (
);

    protected array $bodyParams = array (
);

    protected string $method = 'DELETE';

    protected string $path = '/scim/v2/Users/{user_id}';

    protected string $toolName = 'braze_delete_scim_user';

    protected string $toolDescription = 'Remove a Braze dashboard SCIM user.';
}