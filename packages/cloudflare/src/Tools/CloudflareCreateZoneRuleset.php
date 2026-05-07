<?php

namespace OpenCompany\Integrations\Cloudflare\Tools;

/**
 * Create a zone ruleset.
 *
 * Supports Ruleset Engine create bodies for WAF, transform, redirect, cache,
 * configuration, and origin rules.
 */
class CloudflareCreateZoneRuleset extends AbstractCloudflareTool
{
    protected const NAME = 'cloudflare_create_zone_ruleset';
    protected const DESCRIPTION = 'Create a Cloudflare zone ruleset. Pass name, kind, phase, rules, and optional description or raw body.';
    protected const PARAMETERS = [
        'zone_id' => ['type' => 'string', 'required' => true, 'description' => 'Cloudflare zone identifier.'],
        'name' => ['type' => 'string', 'description' => 'Ruleset name.'],
        'kind' => ['type' => 'string', 'description' => 'Ruleset kind, such as zone.'],
        'phase' => ['type' => 'string', 'description' => 'Ruleset phase, such as http_request_firewall_custom.'],
        'description' => ['type' => 'string', 'description' => 'Ruleset description.'],
        'rules' => ['type' => 'array', 'description' => 'Ruleset rules array.'],
        'body' => ['type' => 'object', 'description' => 'Raw ruleset create body.'],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/zones/{zone_id}/rulesets';
    protected const REQUIRED = ['zone_id'];
    protected const BODY_KEYS = ['name', 'kind', 'phase', 'description', 'rules'];
    protected const BODY_REQUIRED = true;
}
