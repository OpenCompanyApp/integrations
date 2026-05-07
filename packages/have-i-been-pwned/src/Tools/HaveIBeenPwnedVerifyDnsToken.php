<?php

namespace OpenCompany\Integrations\HaveIBeenPwned\Tools;

/**
 * Verify DNS TXT token ownership for a domain.
 */
class HaveIBeenPwnedVerifyDnsToken extends AbstractHaveIBeenPwnedTool
{
    protected const NAME = 'hibp_verify_dns_token';
    protected const DESCRIPTION = 'Ask HIBP to verify the DNS TXT ownership token for a domain. Requires an HIBP API key.';
    protected const METHOD = 'verifyDnsToken';
    protected const REQUIRED = ['domain'];
    protected const PARAMETERS = [
        'domain' => ['type' => 'string', 'required' => true, 'description' => 'Domain name with the HIBP TXT token published.'],
    ];
}
