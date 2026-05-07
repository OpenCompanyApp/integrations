<?php

namespace OpenCompany\Integrations\Cloudflare\Tools;

/**
 * Get one zone ruleset.
 *
 * Returns the ruleset definition including phase, kind, and rules.
 */
class CloudflareGetZoneRuleset extends AbstractCloudflareTool
{
    protected const NAME = 'cloudflare_get_zone_ruleset';
    protected const DESCRIPTION = 'Get one Cloudflare zone ruleset.';
    protected const PARAMETERS = [
        'zone_id' => ['type' => 'string', 'required' => true, 'description' => 'Cloudflare zone identifier.'],
        'ruleset_id' => ['type' => 'string', 'required' => true, 'description' => 'Ruleset identifier.'],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/zones/{zone_id}/rulesets/{ruleset_id}';
    protected const REQUIRED = ['zone_id', 'ruleset_id'];
}
