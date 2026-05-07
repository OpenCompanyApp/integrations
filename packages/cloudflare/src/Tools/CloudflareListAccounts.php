<?php

namespace OpenCompany\Integrations\Cloudflare\Tools;

/**
 * List Cloudflare accounts visible to the token.
 *
 * Supports standard Cloudflare pagination and account name filters.
 */
class CloudflareListAccounts extends AbstractCloudflareTool
{
    protected const NAME = 'cloudflare_list_accounts';
    protected const DESCRIPTION = 'List Cloudflare accounts visible to the authenticated API token.';
    protected const PARAMETERS = [
        'name' => ['type' => 'string', 'description' => 'Filter by account name.'],
        'page' => ['type' => 'integer', 'description' => 'Page number.'],
        'per_page' => ['type' => 'integer', 'description' => 'Results per page.'],
        'direction' => ['type' => 'string', 'description' => 'Sort direction, asc or desc.'],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/accounts';
    protected const QUERY_KEYS = ['name', 'page', 'per_page', 'direction'];
}
