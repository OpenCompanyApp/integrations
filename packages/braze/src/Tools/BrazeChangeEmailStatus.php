<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Change an email subscription status.
 */
class BrazeChangeEmailStatus extends AbstractBrazeTool
{
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Email status payload.',
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

    protected string $path = '/email/status';

    protected string $toolName = 'braze_change_email_status';

    protected string $toolDescription = 'Change an email subscription status.';
}