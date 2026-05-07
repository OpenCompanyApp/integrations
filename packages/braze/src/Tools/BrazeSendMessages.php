<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Send immediate API-only messages.
 */
class BrazeSendMessages extends AbstractBrazeTool
{
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Messages API payload.',
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

    protected string $path = '/messages/send';

    protected string $toolName = 'braze_send_messages';

    protected string $toolDescription = 'Send immediate API-only messages.';
}