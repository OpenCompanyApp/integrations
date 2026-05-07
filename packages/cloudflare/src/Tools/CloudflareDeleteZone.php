<?php

namespace OpenCompany\Integrations\Cloudflare\Tools;

/**
 * Delete a Cloudflare zone.
 *
 * Removes the zone from the account.
 */
class CloudflareDeleteZone extends AbstractCloudflareTool
{
    protected const NAME = 'cloudflare_delete_zone';
    protected const DESCRIPTION = 'Delete a Cloudflare zone by zone_id.';
    protected const PARAMETERS = [
        'zone_id' => ['type' => 'string', 'required' => true, 'description' => 'Cloudflare zone identifier.'],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/zones/{zone_id}';
    protected const REQUIRED = ['zone_id'];
}
