<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Update an email template.
 */
class BrazeUpdateEmailTemplate extends AbstractBrazeTool
{
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Email template update payload.',
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

    protected string $path = '/templates/email/update';

    protected string $toolName = 'braze_update_email_template';

    protected string $toolDescription = 'Update an email template.';
}