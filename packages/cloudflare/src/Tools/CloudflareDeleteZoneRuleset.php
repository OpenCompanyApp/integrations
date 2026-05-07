<?php

namespace OpenCompany\Integrations\Cloudflare\Tools;

/**
 * Delete a zone ruleset.
 *
 * Removes one Ruleset Engine ruleset from a zone.
 */
class CloudflareDeleteZoneRuleset extends AbstractCloudflareTool
{
    protected const NAME = 'cloudflare_delete_zone_ruleset';
    protected const DESCRIPTION = 'Delete a Cloudflare zone ruleset.';
    protected const PARAMETERS = [
        'zone_id' => ['type' => 'string', 'required' => true, 'description' => 'Cloudflare zone identifier.'],
        'ruleset_id' => ['type' => 'string', 'required' => true, 'description' => 'Ruleset identifier.'],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/zones/{zone_id}/rulesets/{ruleset_id}';
    protected const REQUIRED = ['zone_id', 'ruleset_id'];
}
