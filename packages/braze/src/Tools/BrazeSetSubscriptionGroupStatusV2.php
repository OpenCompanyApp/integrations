<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Update users subscription group status using v2 semantics.
 */
class BrazeSetSubscriptionGroupStatusV2 extends AbstractBrazeTool
{
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Subscription status payload.',
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

    protected string $path = '/v2/subscription/status/set';

    protected string $toolName = 'braze_set_subscription_group_status_v2';

    protected string $toolDescription = 'Update users subscription group status using v2 semantics.';
}