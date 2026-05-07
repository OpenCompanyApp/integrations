<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Look up a Braze dashboard SCIM user.
 */
class BrazeGetScimUser extends AbstractBrazeTool
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

    protected string $method = 'GET';

    protected string $path = '/scim/v2/Users/{user_id}';

    protected string $toolName = 'braze_get_scim_user';

    protected string $toolDescription = 'Look up a Braze dashboard SCIM user.';
}