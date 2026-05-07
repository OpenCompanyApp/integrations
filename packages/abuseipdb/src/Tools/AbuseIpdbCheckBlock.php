<?php

namespace OpenCompany\Integrations\AbuseIpdb\Tools;

/**
 * Check AbuseIPDB data for a CIDR block.
 */
class AbuseIpdbCheckBlock extends AbstractAbuseIpdbTool
{
    protected const NAME = 'abuseipdb_check_block';
    protected const DESCRIPTION = 'Check AbuseIPDB reputation data for an IPv4 or IPv6 CIDR block.';
    protected const METHOD = 'checkBlock';
    protected const REQUIRED = ['network'];
    protected const PARAMETERS = [
        'network' => ['type' => 'string', 'required' => true, 'description' => 'IPv4 or IPv6 CIDR network, such as 192.0.2.0/24.'],
        'max_age_in_days' => ['type' => 'integer', 'required' => false, 'description' => 'Only include reports from the last N days. AbuseIPDB allows 1-365.'],
    ];
}
