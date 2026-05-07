<?php

namespace OpenCompany\Integrations\HaveIBeenPwned\Tools;

/**
 * List paste records for a specific email address.
 */
class HaveIBeenPwnedPasteAccount extends AbstractHaveIBeenPwnedTool
{
    protected const NAME = 'hibp_paste_account';
    protected const DESCRIPTION = 'List paste records for an email address. Requires an HIBP API key and returns an empty array when no pastes are found.';
    protected const METHOD = 'pasteAccount';
    protected const REQUIRED = ['account'];
    protected const PARAMETERS = [
        'account' => ['type' => 'string', 'required' => true, 'description' => 'Email address to search for paste records.'],
    ];
}
