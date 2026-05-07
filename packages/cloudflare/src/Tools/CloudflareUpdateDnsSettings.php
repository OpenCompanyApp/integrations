<?php

namespace OpenCompany\Integrations\Cloudflare\Tools;

/**
 * Update DNS settings for a Cloudflare zone.
 *
 * Sends the DNS settings patch body documented by Cloudflare.
 */
class CloudflareUpdateDnsSettings extends AbstractCloudflareTool
{
    protected const NAME = 'cloudflare_update_dns_settings';
    protected const DESCRIPTION = 'Update DNS settings for a Cloudflare zone. Pass changed DNS setting fields in body.';
    protected const PARAMETERS = [
        'zone_id' => ['type' => 'string', 'required' => true, 'description' => 'Cloudflare zone identifier.'],
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Cloudflare DNS settings update body.'],
    ];
    protected const METHOD = 'PATCH';
    protected const PATH = '/zones/{zone_id}/dns_settings';
    protected const REQUIRED = ['zone_id'];
    protected const BODY_REQUIRED = true;
}
