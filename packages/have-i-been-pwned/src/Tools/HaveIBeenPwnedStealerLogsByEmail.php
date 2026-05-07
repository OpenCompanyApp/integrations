<?php

namespace OpenCompany\Integrations\HaveIBeenPwned\Tools;

/**
 * Check stealer-log website domains associated with an email address.
 */
class HaveIBeenPwnedStealerLogsByEmail extends AbstractHaveIBeenPwnedTool
{
    protected const NAME = 'hibp_stealer_logs_by_email';
    protected const DESCRIPTION = 'List website domains found in stealer logs for an email address. Requires an HIBP API key.';
    protected const METHOD = 'stealerLogsByEmail';
    protected const REQUIRED = ['email'];
    protected const PARAMETERS = [
        'email' => ['type' => 'string', 'required' => true, 'description' => 'Email address to search in stealer logs.'],
    ];
}
