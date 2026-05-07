<?php

namespace OpenCompany\Integrations\Cloudflare\Tools;

/**
 * Import DNS records.
 *
 * Accepts the Cloudflare DNS import endpoint body supplied by the caller.
 */
class CloudflareImportDnsRecords extends AbstractCloudflareTool
{
    protected const NAME = 'cloudflare_import_dns_records';
    protected const DESCRIPTION = 'Import DNS records for a zone. Pass the request body expected by Cloudflare.';
    protected const PARAMETERS = [
        'zone_id' => ['type' => 'string', 'required' => true, 'description' => 'Cloudflare zone identifier.'],
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Cloudflare DNS records import body.'],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/zones/{zone_id}/dns_records/import';
    protected const REQUIRED = ['zone_id'];
    protected const BODY_REQUIRED = true;
}
