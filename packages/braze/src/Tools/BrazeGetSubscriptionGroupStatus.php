<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * List users subscription group status.
 */
class BrazeGetSubscriptionGroupStatus extends AbstractBrazeTool
{
    protected array $parameters = array (
  'subscription_group_id' =>
  array (
    'type' => 'string',
    'description' => 'Subscription group ID.',
  ),
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
  0 => 'subscription_group_id',
  1 => 'external_id',
  2 => 'email',
  3 => 'phone',
);

    protected array $bodyParams = array (
);

    protected string $method = 'GET';

    protected string $path = '/subscription/status/get';

    protected string $toolName = 'braze_get_subscription_group_status';

    protected string $toolDescription = 'List users subscription group status.';
}