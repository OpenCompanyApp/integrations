<?php

namespace OpenCompany\Integrations\Cloudflare\Tools;

/**
 * Create a Cloudflare page rule.
 *
 * Page rules are legacy but still common in existing Cloudflare zones.
 */
class CloudflareCreatePageRule extends AbstractCloudflareTool
{
    protected const NAME = 'cloudflare_create_page_rule';
    protected const DESCRIPTION = 'Create a Cloudflare page rule for a zone. Pass targets/actions/priority/status in body or first-class fields.';
    protected const PARAMETERS = [
        'zone_id' => ['type' => 'string', 'required' => true, 'description' => 'Cloudflare zone identifier.'],
        'targets' => ['type' => 'array', 'description' => 'Cloudflare page rule targets.'],
        'actions' => ['type' => 'array', 'description' => 'Cloudflare page rule actions.'],
        'priority' => ['type' => 'integer', 'description' => 'Rule priority.'],
        'status' => ['type' => 'string', 'description' => 'Rule status, active or disabled.'],
        'body' => ['type' => 'object', 'description' => 'Raw page rule create body.'],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/zones/{zone_id}/pagerules';
    protected const REQUIRED = ['zone_id'];
    protected const BODY_KEYS = ['targets', 'actions', 'priority', 'status'];
    protected const BODY_REQUIRED = true;
}
