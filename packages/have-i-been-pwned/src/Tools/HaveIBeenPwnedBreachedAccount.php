<?php

namespace OpenCompany\Integrations\HaveIBeenPwned\Tools;

/**
 * List breaches associated with a specific email address.
 */
class HaveIBeenPwnedBreachedAccount extends AbstractHaveIBeenPwnedTool
{
    protected const NAME = 'hibp_breached_account';
    protected const DESCRIPTION = 'List breaches for an email address. Requires an HIBP API key and returns an empty array when the address is not found.';
    protected const METHOD = 'breachedAccount';
    protected const REQUIRED = ['account'];
    protected const PARAMETERS = [
        'account' => ['type' => 'string', 'required' => true, 'description' => 'Email address to search.'],
        'truncate_response' => ['type' => 'boolean', 'required' => false, 'description' => 'Set false to return complete breach models instead of only breach names.'],
        'domain' => ['type' => 'string', 'required' => false, 'description' => 'Filter results to breaches against this domain.'],
        'include_unverified' => ['type' => 'boolean', 'required' => false, 'description' => 'Set false to exclude unverified breaches.'],
    ];
}
