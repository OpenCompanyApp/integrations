<?php

namespace OpenCompany\Integrations\Cloudflare\Tools;

/**
 * Patch a DNS record.
 *
 * Sends partial DNS record changes to Cloudflare.
 */
class CloudflarePatchDnsRecord extends AbstractCloudflareTool
{
    protected const NAME = 'cloudflare_patch_dns_record';
    protected const DESCRIPTION = 'Patch a DNS record using PATCH. Provide changed fields or raw body.';
    protected const PARAMETERS = [
        'zone_id' => ['type' => 'string', 'required' => true, 'description' => 'Cloudflare zone identifier.'],
        'dns_record_id' => ['type' => 'string', 'required' => true, 'description' => 'DNS record identifier.'],
        'type' => ['type' => 'string', 'description' => 'DNS record type.'],
        'name' => ['type' => 'string', 'description' => 'DNS record name.'],
        'content' => ['type' => 'string', 'description' => 'DNS record content.'],
        'ttl' => ['type' => 'integer', 'description' => 'Record TTL.'],
        'proxied' => ['type' => 'boolean', 'description' => 'Whether Cloudflare proxies this record.'],
        'body' => ['type' => 'object', 'description' => 'Raw DNS record patch body.'],
    ];
    protected const METHOD = 'PATCH';
    protected const PATH = '/zones/{zone_id}/dns_records/{dns_record_id}';
    protected const REQUIRED = ['zone_id', 'dns_record_id'];
    protected const BODY_KEYS = ['type', 'name', 'content', 'ttl', 'proxied'];
    protected const BODY_REQUIRED = true;
}
