<?php

namespace OpenCompany\Integrations\Cloudflare\Tools;

/**
 * Get a Cloudflare account.
 *
 * Returns the account object for tokens with account read permissions.
 */
class CloudflareGetAccount extends AbstractCloudflareTool
{
    protected const NAME = 'cloudflare_get_account';
    protected const DESCRIPTION = 'Get a Cloudflare account by account_id.';
    protected const PARAMETERS = [
        'account_id' => ['type' => 'string', 'required' => true, 'description' => 'Cloudflare account identifier.'],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/accounts/{account_id}';
    protected const REQUIRED = ['account_id'];
}
