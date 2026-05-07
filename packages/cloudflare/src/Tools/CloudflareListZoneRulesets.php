<?php

namespace OpenCompany\Integrations\Cloudflare\Tools;

/**
 * List rulesets for a Cloudflare zone.
 *
 * Covers the modern Ruleset Engine surface used by WAF, transform, redirect,
 * cache, configuration, and origin rules.
 */
class CloudflareListZoneRulesets extends AbstractCloudflareTool
{
    protected const NAME = 'cloudflare_list_zone_rulesets';
    protected const DESCRIPTION = 'List Ruleset Engine rulesets for a Cloudflare zone.';
    protected const PARAMETERS = [
        'zone_id' => ['type' => 'string', 'required' => true, 'description' => 'Cloudflare zone identifier.'],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/zones/{zone_id}/rulesets';
    protected const REQUIRED = ['zone_id'];
}
