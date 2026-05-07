<?php

namespace OpenCompany\Integrations\AbuseIpdb\Tools;

/**
 * Retrieve the AbuseIPDB blacklist feed.
 */
class AbuseIpdbBlacklist extends AbstractAbuseIpdbTool
{
    protected const NAME = 'abuseipdb_blacklist';
    protected const DESCRIPTION = 'Retrieve the AbuseIPDB blacklist feed in JSON or plaintext form.';
    protected const METHOD = 'blacklist';
    protected const PARAMETERS = [
        'confidence_minimum' => ['type' => 'integer', 'required' => false, 'description' => 'Minimum abuse confidence score for returned IPs.'],
        'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum IPs requested. AbuseIPDB truncates to the account tier limit.'],
        'only_countries' => ['type' => 'string', 'required' => false, 'description' => 'Comma-separated ISO 3166 alpha-2 country codes to include. Subscriber feature.'],
        'except_countries' => ['type' => 'string', 'required' => false, 'description' => 'Comma-separated ISO 3166 alpha-2 country codes to exclude. Subscriber feature.'],
        'ip_version' => ['type' => 'integer', 'required' => false, 'description' => 'IP version filter.', 'enum' => [4, 6]],
        'plaintext' => ['type' => 'boolean', 'required' => false, 'description' => 'Return newline-separated IPs parsed into data plus the raw body.'],
    ];
}
