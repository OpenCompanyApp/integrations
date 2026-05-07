<?php

namespace OpenCompany\Integrations\Cloudflare\Tools;

/**
 * Delete a Cloudflare page rule.
 *
 * Removes a legacy page rule from a zone.
 */
class CloudflareDeletePageRule extends AbstractCloudflareTool
{
    protected const NAME = 'cloudflare_delete_page_rule';
    protected const DESCRIPTION = 'Delete a Cloudflare page rule.';
    protected const PARAMETERS = [
        'zone_id' => ['type' => 'string', 'required' => true, 'description' => 'Cloudflare zone identifier.'],
        'pagerule_id' => ['type' => 'string', 'required' => true, 'description' => 'Page rule identifier.'],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/zones/{zone_id}/pagerules/{pagerule_id}';
    protected const REQUIRED = ['zone_id', 'pagerule_id'];
}
