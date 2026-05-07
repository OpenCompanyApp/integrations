<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Delete an SDK authentication key.
 */
class BrazeDeleteSdkAuthenticationKey extends AbstractBrazeTool
{
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'SDK authentication key delete payload.',
  ),
);

    protected array $required = array (
);

    protected array $queryParams = array (
);

    protected array $bodyParams = array (
  0 => 'payload',
);

    protected string $method = 'DELETE';

    protected string $path = '/app_group/sdk_authentication/delete';

    protected string $toolName = 'braze_delete_sdk_authentication_key';

    protected string $toolDescription = 'Delete an SDK authentication key.';
}