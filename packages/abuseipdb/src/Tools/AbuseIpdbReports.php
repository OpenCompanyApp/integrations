<?php

namespace OpenCompany\Integrations\AbuseIpdb\Tools;

/**
 * List reports for one IP address.
 */
class AbuseIpdbReports extends AbstractAbuseIpdbTool
{
    protected const NAME = 'abuseipdb_reports';
    protected const DESCRIPTION = 'List AbuseIPDB reports for one IPv4 or IPv6 address with optional pagination.';
    protected const METHOD = 'reports';
    protected const REQUIRED = ['ip_address'];
    protected const PARAMETERS = [
        'ip_address' => ['type' => 'string', 'required' => true, 'description' => 'IPv4 or IPv6 address to inspect.'],
        'max_age_in_days' => ['type' => 'integer', 'required' => false, 'description' => 'Only include reports from the last N days. AbuseIPDB allows 1-365.'],
        'page' => ['type' => 'integer', 'required' => false, 'description' => 'Page number. Default is 1.'],
        'per_page' => ['type' => 'integer', 'required' => false, 'description' => 'Reports per page. AbuseIPDB allows 1-100.'],
    ];
}
