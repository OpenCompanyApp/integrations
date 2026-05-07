<?php

namespace OpenCompany\Integrations\HaveIBeenPwned\Tools;

/**
 * Query the k-anonymity email breach endpoint by six-character SHA-1 prefix.
 */
class HaveIBeenPwnedBreachedAccountRange extends AbstractHaveIBeenPwnedTool
{
    protected const NAME = 'hibp_breached_account_range';
    protected const DESCRIPTION = 'List email hash suffixes and breach names for a six-character SHA-1 prefix. Requires an HIBP API key.';
    protected const METHOD = 'breachedAccountRange';
    protected const REQUIRED = ['prefix'];
    protected const PARAMETERS = [
        'prefix' => ['type' => 'string', 'required' => true, 'description' => 'First 6 hexadecimal characters of the SHA-1 hash of the email address.'],
    ];
}
