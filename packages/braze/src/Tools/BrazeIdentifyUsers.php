<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Identify alias-only users with external IDs.
 */
class BrazeIdentifyUsers extends AbstractBrazeTool
{
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Identify users payload.',
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

    protected string $path = '/users/identify';

    protected string $toolName = 'braze_identify_users';

    protected string $toolDescription = 'Identify alias-only users with external IDs.';
}