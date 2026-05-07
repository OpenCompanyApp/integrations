<?php

namespace OpenCompany\Integrations\Cloudflare\Tools;

/**
 * List members in a Cloudflare account.
 *
 * Useful for auditing account access and role assignments.
 */
class CloudflareListAccountMembers extends AbstractCloudflareTool
{
    protected const NAME = 'cloudflare_list_account_members';
    protected const DESCRIPTION = 'List members for a Cloudflare account.';
    protected const PARAMETERS = [
        'account_id' => ['type' => 'string', 'required' => true, 'description' => 'Cloudflare account identifier.'],
        'page' => ['type' => 'integer', 'description' => 'Page number.'],
        'per_page' => ['type' => 'integer', 'description' => 'Results per page.'],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/accounts/{account_id}/members';
    protected const REQUIRED = ['account_id'];
    protected const QUERY_KEYS = ['page', 'per_page'];
}
