<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * List subscription groups for users.
 */
class BrazeListUserSubscriptionGroups extends AbstractBrazeTool
{
    protected array $parameters = array (
  'external_id' =>
  array (
    'type' => 'string',
    'description' => 'External user ID.',
  ),
  'email' =>
  array (
    'type' => 'string',
    'description' => 'Email address.',
  ),
  'phone' =>
  array (
    'type' => 'string',
    'description' => 'Phone number.',
  ),
);

    protected array $required = array (
);

    protected array $queryParams = array (
  0 => 'external_id',
  1 => 'email',
  2 => 'phone',
);

    protected array $bodyParams = array (
);

    protected string $method = 'GET';

    protected string $path = '/subscription/user/status';

    protected string $toolName = 'braze_list_user_subscription_groups';

    protected string $toolDescription = 'List subscription groups for users.';
}