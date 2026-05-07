<?php

namespace OpenCompany\Integrations\HaveIBeenPwned\Tools;

/**
 * Check stealer-log email addresses associated with a compromised website domain.
 */
class HaveIBeenPwnedStealerLogsByWebsiteDomain extends AbstractHaveIBeenPwnedTool
{
    protected const NAME = 'hibp_stealer_logs_by_website_domain';
    protected const DESCRIPTION = 'List email addresses found in stealer logs for a website domain. Requires an HIBP API key.';
    protected const METHOD = 'stealerLogsByWebsiteDomain';
    protected const REQUIRED = ['domain'];
    protected const PARAMETERS = [
        'domain' => ['type' => 'string', 'required' => true, 'description' => 'Website domain from stealer-log records.'],
    ];
}
