<?php

namespace OpenCompany\Integrations\Cloudflare\Tools;

/**
 * Get a DNS record.
 *
 * Returns the full Cloudflare DNS record object for one record ID.
 */
class CloudflareGetDnsRecord extends AbstractCloudflareTool
{
    protected const NAME = 'cloudflare_get_dns_record';
    protected const DESCRIPTION = 'Get one DNS record in a Cloudflare zone.';
    protected const PARAMETERS = [
        'zone_id' => ['type' => 'string', 'required' => true, 'description' => 'Cloudflare zone identifier.'],
        'dns_record_id' => ['type' => 'string', 'required' => true, 'description' => 'DNS record identifier.'],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/zones/{zone_id}/dns_records/{dns_record_id}';
    protected const REQUIRED = ['zone_id', 'dns_record_id'];
}
