<?php

namespace OpenCompany\Integrations\HaveIBeenPwned\Tools;

/**
 * Query the Pwned Passwords k-anonymity range endpoint.
 */
class HaveIBeenPwnedPwnedPasswordRange extends AbstractHaveIBeenPwnedTool
{
    protected const NAME = 'hibp_pwned_password_range';
    protected const DESCRIPTION = 'Query Pwned Passwords by the first five SHA-1 or NTLM hash characters. No API key is required.';
    protected const METHOD = 'pwnedPasswordRange';
    protected const REQUIRED = ['prefix'];
    protected const PARAMETERS = [
        'prefix' => ['type' => 'string', 'required' => true, 'description' => 'First 5 hexadecimal characters of a SHA-1 or NTLM password hash.'],
        'mode' => ['type' => 'string', 'required' => false, 'description' => 'Hash mode.', 'enum' => ['sha1', 'ntlm']],
        'padding' => ['type' => 'boolean', 'required' => false, 'description' => 'Set false to omit Add-Padding. Defaults to true for privacy hardening.'],
    ];
}
