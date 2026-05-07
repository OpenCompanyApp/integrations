<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Get email template information.
 */
class BrazeGetEmailTemplate extends AbstractBrazeTool
{
    protected array $parameters = array (
  'email_template_id' =>
  array (
    'type' => 'string',
    'description' => 'Email template ID.',
    'required' => true,
  ),
);

    protected array $required = array (
  0 => 'email_template_id',
);

    protected array $queryParams = array (
  0 => 'email_template_id',
);

    protected array $bodyParams = array (
);

    protected string $method = 'GET';

    protected string $path = '/templates/email/info';

    protected string $toolName = 'braze_get_email_template';

    protected string $toolDescription = 'Get email template information.';
}