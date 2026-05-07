<?php

namespace OpenCompany\Integrations\HaveIBeenPwned\Tools;

/**
 * List public breach catalogue entries with optional filters.
 */
class HaveIBeenPwnedBreaches extends AbstractHaveIBeenPwnedTool
{
    protected const NAME = 'hibp_breaches';
    protected const DESCRIPTION = 'List public breach catalogue entries, optionally filtered by breached domain or spam-list flag.';
    protected const METHOD = 'breaches';
    protected const PARAMETERS = [
        'domain' => ['type' => 'string', 'required' => false, 'description' => 'Filter breaches to a specific breached domain.'],
        'is_spam_list' => ['type' => 'boolean', 'required' => false, 'description' => 'Filter to breaches that are or are not flagged as spam lists.'],
    ];
}
