<?php

namespace OpenCompany\Integrations\HaveIBeenPwned\Tools;

/**
 * Send a domain verification email to an allowed administrative alias.
 */
class HaveIBeenPwnedSendDomainVerificationEmail extends AbstractHaveIBeenPwnedTool
{
    protected const NAME = 'hibp_send_domain_verification_email';
    protected const DESCRIPTION = 'Send a domain verification email to one of HIBP\'s allowed administrative aliases. Requires an HIBP API key.';
    protected const METHOD = 'sendDomainVerificationEmail';
    protected const REQUIRED = ['domain', 'email_alias'];
    protected const PARAMETERS = [
        'domain' => ['type' => 'string', 'required' => true, 'description' => 'Domain name to verify.'],
        'email_alias' => ['type' => 'string', 'required' => true, 'description' => 'Allowed alias before the at-sign.', 'enum' => ['admin', 'hostmaster', 'info', 'security', 'webmaster']],
    ];
}
