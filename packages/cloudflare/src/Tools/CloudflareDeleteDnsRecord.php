<?php

namespace OpenCompany\Integrations\Cloudflare\Tools;

/**
 * Delete a DNS record.
 *
 * Removes one DNS record from a Cloudflare zone.
 */
class CloudflareDeleteDnsRecord extends AbstractCloudflareTool
{
    protected const NAME = 'cloudflare_delete_dns_record';
    protected const DESCRIPTION = 'Delete one DNS record from a Cloudflare zone.';
    protected const PARAMETERS = [
        'zone_id' => ['type' => 'string', 'required' => true, 'description' => 'Cloudflare zone identifier.'],
        'dns_record_id' => ['type' => 'string', 'required' => true, 'description' => 'DNS record identifier.'],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/zones/{zone_id}/dns_records/{dns_record_id}';
    protected const REQUIRED = ['zone_id', 'dns_record_id'];
}
