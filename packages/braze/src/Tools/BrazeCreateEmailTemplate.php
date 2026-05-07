<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Create an email template.
 */
class BrazeCreateEmailTemplate extends AbstractBrazeTool
{
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Email template payload.',
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

    protected string $path = '/templates/email/create';

    protected string $toolName = 'braze_create_email_template';

    protected string $toolDescription = 'Create an email template.';
}