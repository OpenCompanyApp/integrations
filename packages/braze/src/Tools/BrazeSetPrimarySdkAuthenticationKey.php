<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Set the primary SDK authentication key.
 */
class BrazeSetPrimarySdkAuthenticationKey extends AbstractBrazeTool
{
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Primary key payload.',
  ),
);

    protected array $required = array (
);

    protected array $queryParams = array (
);

    protected array $bodyParams = array (
  0 => 'payload',
);

    protected string $method = 'PUT';

    protected string $path = '/app_group/sdk_authentication/primary';

    protected string $toolName = 'braze_set_primary_sdk_authentication_key';

    protected string $toolDescription = 'Set the primary SDK authentication key.';
}