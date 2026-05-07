<?php

namespace OpenCompany\Integrations\Cloudflare\Tools;

/**
 * Review detected DNS records.
 *
 * Lists records discovered by Cloudflare DNS scanning before they are accepted.
 */
class CloudflareReviewDnsRecordScan extends AbstractCloudflareTool
{
    protected const NAME = 'cloudflare_review_dns_record_scan';
    protected const DESCRIPTION = 'Review DNS records discovered by Cloudflare DNS scan.';
    protected const PARAMETERS = [
        'zone_id' => ['type' => 'string', 'required' => true, 'description' => 'Cloudflare zone identifier.'],
        'page' => ['type' => 'integer', 'description' => 'Page number.'],
        'per_page' => ['type' => 'integer', 'description' => 'Results per page.'],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/zones/{zone_id}/dns_records/scan/review';
    protected const REQUIRED = ['zone_id'];
    protected const QUERY_KEYS = ['page', 'per_page'];
}
