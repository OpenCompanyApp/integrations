<?php

namespace OpenCompany\Integrations\Cloudflare\Tools;

/**
 * Get DNS settings for a Cloudflare zone.
 *
 * Returns zone-level DNS settings such as CNAME flattening and nameserver mode.
 */
class CloudflareGetDnsSettings extends AbstractCloudflareTool
{
    protected const NAME = 'cloudflare_get_dns_settings';
    protected const DESCRIPTION = 'Get DNS settings for a Cloudflare zone.';
    protected const PARAMETERS = [
        'zone_id' => ['type' => 'string', 'required' => true, 'description' => 'Cloudflare zone identifier.'],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/zones/{zone_id}/dns_settings';
    protected const REQUIRED = ['zone_id'];
}
