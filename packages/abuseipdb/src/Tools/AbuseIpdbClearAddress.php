<?php

namespace OpenCompany\Integrations\AbuseIpdb\Tools;

/**
 * Clear reports for one IP address from this account.
 */
class AbuseIpdbClearAddress extends AbstractAbuseIpdbTool
{
    protected const NAME = 'abuseipdb_clear_address';
    protected const DESCRIPTION = 'Clear reports for one IP address from the configured AbuseIPDB account only.';
    protected const METHOD = 'clearAddress';
    protected const REQUIRED = ['ip_address'];
    protected const PARAMETERS = [
        'ip_address' => ['type' => 'string', 'required' => true, 'description' => 'IPv4 or IPv6 address whose reports should be cleared from this account.'],
    ];
}
