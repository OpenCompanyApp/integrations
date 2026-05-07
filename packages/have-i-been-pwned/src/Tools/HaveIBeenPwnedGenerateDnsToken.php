<?php

namespace OpenCompany\Integrations\HaveIBeenPwned\Tools;

/**
 * Generate a DNS ownership-verification token for a domain.
 */
class HaveIBeenPwnedGenerateDnsToken extends AbstractHaveIBeenPwnedTool
{
    protected const NAME = 'hibp_generate_dns_token';
    protected const DESCRIPTION = 'Generate an HIBP DNS TXT token for domain ownership verification. Requires an HIBP API key.';
    protected const METHOD = 'generateDnsToken';
    protected const REQUIRED = ['domain'];
    protected const PARAMETERS = [
        'domain' => ['type' => 'string', 'required' => true, 'description' => 'Domain name to verify.'],
    ];
}
