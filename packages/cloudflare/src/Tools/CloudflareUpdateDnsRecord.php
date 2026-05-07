<?php

namespace OpenCompany\Integrations\Cloudflare\Tools;

/**
 * Replace a DNS record.
 *
 * Uses Cloudflare's PUT DNS record endpoint and should receive a complete DNS
 * record body.
 */
class CloudflareUpdateDnsRecord extends AbstractCloudflareTool
{
    protected const NAME = 'cloudflare_update_dns_record';
    protected const DESCRIPTION = 'Replace a DNS record using PUT. Provide type, name, content, and optional ttl/proxied or raw body.';
    protected const PARAMETERS = [
        'zone_id' => ['type' => 'string', 'required' => true, 'description' => 'Cloudflare zone identifier.'],
        'dns_record_id' => ['type' => 'string', 'required' => true, 'description' => 'DNS record identifier.'],
        'type' => ['type' => 'string', 'description' => 'DNS record type.'],
        'name' => ['type' => 'string', 'description' => 'DNS record name.'],
        'content' => ['type' => 'string', 'description' => 'DNS record content.'],
        'ttl' => ['type' => 'integer', 'description' => 'Record TTL. Use 1 for automatic.'],
        'proxied' => ['type' => 'boolean', 'description' => 'Whether Cloudflare proxies this record.'],
        'body' => ['type' => 'object', 'description' => 'Raw DNS record body.'],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/zones/{zone_id}/dns_records/{dns_record_id}';
    protected const REQUIRED = ['zone_id', 'dns_record_id'];
    protected const BODY_KEYS = ['type', 'name', 'content', 'ttl', 'proxied'];
    protected const BODY_REQUIRED = true;
}
