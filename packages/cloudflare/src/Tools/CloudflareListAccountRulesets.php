<?php

namespace OpenCompany\Integrations\Cloudflare\Tools;

/**
 * List account-level rulesets.
 *
 * Covers account-scoped Ruleset Engine surfaces.
 */
class CloudflareListAccountRulesets extends AbstractCloudflareTool
{
    protected const NAME = 'cloudflare_list_account_rulesets';
    protected const DESCRIPTION = 'List Ruleset Engine rulesets for a Cloudflare account.';
    protected const PARAMETERS = [
        'account_id' => ['type' => 'string', 'required' => true, 'description' => 'Cloudflare account identifier.'],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/accounts/{account_id}/rulesets';
    protected const REQUIRED = ['account_id'];
}
