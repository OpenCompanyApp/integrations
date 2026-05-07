<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Blocklist email addresses in Braze.
 */
class BrazeBlocklistEmails extends AbstractBrazeTool
{
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Email blocklist payload.',
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

    protected string $path = '/email/blocklist';

    protected string $toolName = 'braze_blocklist_emails';

    protected string $toolDescription = 'Blocklist email addresses in Braze.';
}
