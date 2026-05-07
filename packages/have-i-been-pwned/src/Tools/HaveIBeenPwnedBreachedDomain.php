<?php

namespace OpenCompany\Integrations\HaveIBeenPwned\Tools;

/**
 * List breached accounts for a verified domain.
 */
class HaveIBeenPwnedBreachedDomain extends AbstractHaveIBeenPwnedTool
{
    protected const NAME = 'hibp_breached_domain';
    protected const DESCRIPTION = 'List email aliases and breached sites for a verified domain. Requires an HIBP API key with domain access.';
    protected const METHOD = 'breachedDomain';
    protected const REQUIRED = ['domain'];
    protected const PARAMETERS = [
        'domain' => ['type' => 'string', 'required' => true, 'description' => 'Verified domain name.'],
    ];
}
