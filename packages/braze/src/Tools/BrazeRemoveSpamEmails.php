<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Remove email addresses from the spam list.
 */
class BrazeRemoveSpamEmails extends AbstractBrazeTool
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

    protected string $path = '/email/spam/remove';

    protected string $toolName = 'braze_remove_spam_emails';

    protected string $toolDescription = 'Remove email addresses from the spam list.';
}