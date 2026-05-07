<?php

namespace OpenCompany\Integrations\AbuseIpdb\Tools;

/**
 * Submit one abuse report.
 */
class AbuseIpdbReport extends AbstractAbuseIpdbTool
{
    protected const NAME = 'abuseipdb_report';
    protected const DESCRIPTION = 'Submit an AbuseIPDB report for one IP address. Avoid including private or personally identifiable data in comments.';
    protected const METHOD = 'report';
    protected const REQUIRED = ['ip_address', 'categories'];
    protected const PARAMETERS = [
        'ip_address' => ['type' => 'string', 'required' => true, 'description' => 'IPv4 or IPv6 address to report.'],
        'categories' => ['type' => 'array', 'required' => true, 'description' => 'AbuseIPDB category IDs.', 'items' => ['type' => 'integer']],
        'comment' => ['type' => 'string', 'required' => false, 'description' => 'Relevant report comment. AbuseIPDB truncates long comments; do not include PII.'],
        'timestamp' => ['type' => 'string', 'required' => false, 'description' => 'ISO 8601 event timestamp, if known.'],
    ];
}
