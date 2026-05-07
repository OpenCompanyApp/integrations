<?php

namespace OpenCompany\Integrations\Cloudflare\Tools;

/**
 * Start a DNS record scan.
 *
 * Asks Cloudflare to scan authoritative DNS for importable records.
 */
class CloudflareScanDnsRecords extends AbstractCloudflareTool
{
    protected const NAME = 'cloudflare_scan_dns_records';
    protected const DESCRIPTION = 'Start Cloudflare DNS record scan for a zone.';
    protected const PARAMETERS = [
        'zone_id' => ['type' => 'string', 'required' => true, 'description' => 'Cloudflare zone identifier.'],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/zones/{zone_id}/dns_records/scan';
    protected const REQUIRED = ['zone_id'];
}
