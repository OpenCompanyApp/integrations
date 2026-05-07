<?php

namespace OpenCompany\Integrations\Cloudflare\Tools;

/**
 * List roles available in a Cloudflare account.
 *
 * Helps agents map member role identifiers to human-readable role names.
 */
class CloudflareListAccountRoles extends AbstractCloudflareTool
{
    protected const NAME = 'cloudflare_list_account_roles';
    protected const DESCRIPTION = 'List roles available for a Cloudflare account.';
    protected const PARAMETERS = [
        'account_id' => ['type' => 'string', 'required' => true, 'description' => 'Cloudflare account identifier.'],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/accounts/{account_id}/roles';
    protected const REQUIRED = ['account_id'];
}
