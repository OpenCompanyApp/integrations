<?php

namespace OpenCompany\Integrations\HaveIBeenPwned\Tools;

/**
 * Check stealer logs for accounts under an email-address domain.
 */
class HaveIBeenPwnedStealerLogsByEmailDomain extends AbstractHaveIBeenPwnedTool
{
    protected const NAME = 'hibp_stealer_logs_by_email_domain';
    protected const DESCRIPTION = 'List stealer-log records grouped by account under an email-address domain. Requires an HIBP API key.';
    protected const METHOD = 'stealerLogsByEmailDomain';
    protected const REQUIRED = ['domain'];
    protected const PARAMETERS = [
        'domain' => ['type' => 'string', 'required' => true, 'description' => 'Email-address domain to search, such as example.com.'],
    ];
}
