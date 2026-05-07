<?php

namespace OpenCompany\Integrations\AbuseIpdb\Tools;

/**
 * Check AbuseIPDB reputation for one IP address.
 */
class AbuseIpdbCheck extends AbstractAbuseIpdbTool
{
    protected const NAME = 'abuseipdb_check';
    protected const DESCRIPTION = 'Check AbuseIPDB reputation for one IPv4 or IPv6 address.';
    protected const METHOD = 'check';
    protected const REQUIRED = ['ip_address'];
    protected const PARAMETERS = [
        'ip_address' => ['type' => 'string', 'required' => true, 'description' => 'IPv4 or IPv6 address to check.'],
        'max_age_in_days' => ['type' => 'integer', 'required' => false, 'description' => 'Only include reports from the last N days. AbuseIPDB allows 1-365.'],
        'verbose' => ['type' => 'boolean', 'required' => false, 'description' => 'When true, include report comments and reporter IDs when available.'],
    ];
}
