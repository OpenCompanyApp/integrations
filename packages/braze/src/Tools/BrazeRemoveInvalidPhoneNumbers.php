<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Remove invalid phone number flags.
 */
class BrazeRemoveInvalidPhoneNumbers extends AbstractBrazeTool
{
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Invalid phone removal payload.',
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

    protected string $path = '/sms/invalid_phone_numbers/remove';

    protected string $toolName = 'braze_remove_invalid_phone_numbers';

    protected string $toolDescription = 'Remove invalid phone number flags.';
}