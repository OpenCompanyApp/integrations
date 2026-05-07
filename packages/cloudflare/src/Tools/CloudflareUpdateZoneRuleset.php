<?php

namespace OpenCompany\Integrations\Cloudflare\Tools;

/**
 * Update a zone ruleset.
 *
 * Sends a Ruleset Engine update body for one ruleset.
 */
class CloudflareUpdateZoneRuleset extends AbstractCloudflareTool
{
    protected const NAME = 'cloudflare_update_zone_ruleset';
    protected const DESCRIPTION = 'Update a Cloudflare zone ruleset by ruleset_id.';
    protected const PARAMETERS = [
        'zone_id' => ['type' => 'string', 'required' => true, 'description' => 'Cloudflare zone identifier.'],
        'ruleset_id' => ['type' => 'string', 'required' => true, 'description' => 'Ruleset identifier.'],
        'name' => ['type' => 'string', 'description' => 'Ruleset name.'],
        'kind' => ['type' => 'string', 'description' => 'Ruleset kind.'],
        'phase' => ['type' => 'string', 'description' => 'Ruleset phase.'],
        'description' => ['type' => 'string', 'description' => 'Ruleset description.'],
        'rules' => ['type' => 'array', 'description' => 'Ruleset rules array.'],
        'body' => ['type' => 'object', 'description' => 'Raw ruleset update body.'],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/zones/{zone_id}/rulesets/{ruleset_id}';
    protected const REQUIRED = ['zone_id', 'ruleset_id'];
    protected const BODY_KEYS = ['name', 'kind', 'phase', 'description', 'rules'];
    protected const BODY_REQUIRED = true;
}
