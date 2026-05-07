<?php

namespace OpenCompany\Integrations\Cloudflare\Tools;

/**
 * Export DNS records as a BIND zone file response.
 *
 * Calls Cloudflare's DNS records export endpoint.
 */
class CloudflareExportDnsRecords extends AbstractCloudflareTool
{
    protected const NAME = 'cloudflare_export_dns_records';
    protected const DESCRIPTION = 'Export DNS records for a zone using Cloudflare DNS records export.';
    protected const PARAMETERS = [
        'zone_id' => ['type' => 'string', 'required' => true, 'description' => 'Cloudflare zone identifier.'],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/zones/{zone_id}/dns_records/export';
    protected const REQUIRED = ['zone_id'];
}
