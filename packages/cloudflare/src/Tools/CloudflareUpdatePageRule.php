<?php

namespace OpenCompany\Integrations\Cloudflare\Tools;

/**
 * Update a Cloudflare page rule.
 *
 * Sends a full or partial page rule body to the page rule update endpoint.
 */
class CloudflareUpdatePageRule extends AbstractCloudflareTool
{
    protected const NAME = 'cloudflare_update_page_rule';
    protected const DESCRIPTION = 'Update a Cloudflare page rule. Pass changed fields in body or first-class fields.';
    protected const PARAMETERS = [
        'zone_id' => ['type' => 'string', 'required' => true, 'description' => 'Cloudflare zone identifier.'],
        'pagerule_id' => ['type' => 'string', 'required' => true, 'description' => 'Page rule identifier.'],
        'targets' => ['type' => 'array', 'description' => 'Cloudflare page rule targets.'],
        'actions' => ['type' => 'array', 'description' => 'Cloudflare page rule actions.'],
        'priority' => ['type' => 'integer', 'description' => 'Rule priority.'],
        'status' => ['type' => 'string', 'description' => 'Rule status, active or disabled.'],
        'body' => ['type' => 'object', 'description' => 'Raw page rule update body.'],
    ];
    protected const METHOD = 'PATCH';
    protected const PATH = '/zones/{zone_id}/pagerules/{pagerule_id}';
    protected const REQUIRED = ['zone_id', 'pagerule_id'];
    protected const BODY_KEYS = ['targets', 'actions', 'priority', 'status'];
    protected const BODY_REQUIRED = true;
}
