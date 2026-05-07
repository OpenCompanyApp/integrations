<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Create an SDK authentication key.
 */
class BrazeCreateSdkAuthenticationKey extends AbstractBrazeTool
{
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'SDK authentication key payload.',
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

    protected string $path = '/app_group/sdk_authentication/create';

    protected string $toolName = 'braze_create_sdk_authentication_key';

    protected string $toolDescription = 'Create an SDK authentication key.';
}