<?php

namespace OpenCompany\Integrations\AbuseIpdb\Tools;

/**
 * Submit a CSV of abuse reports.
 */
class AbuseIpdbBulkReport extends AbstractAbuseIpdbTool
{
    protected const NAME = 'abuseipdb_bulk_report';
    protected const DESCRIPTION = 'Submit AbuseIPDB reports in bulk using CSV content.';
    protected const METHOD = 'bulkReport';
    protected const REQUIRED = ['csv'];
    protected const PARAMETERS = [
        'csv' => ['type' => 'string', 'required' => true, 'description' => 'CSV content in AbuseIPDB bulk-report format. Use fake data in tests and avoid private log data in shared artifacts.'],
    ];
}
