<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Remove email addresses from the hard bounce list.
 */
class BrazeRemoveHardBounces extends AbstractBrazeTool
{
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Email removal payload.',
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

    protected string $path = '/email/bounce/remove';

    protected string $toolName = 'braze_remove_hard_bounces';

    protected string $toolDescription = 'Remove email addresses from the hard bounce list.';
}