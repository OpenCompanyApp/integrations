<?php

namespace OpenCompany\Integrations\Nvd\Tools;

/**
 * Search NVD CVE records with official 2.0 filters.
 */
class NvdCves extends AbstractNvdTool
{
    protected const NAME = 'nvd_cves';
    protected const DESCRIPTION = 'Search NVD CVE records using official 2.0 filters such as cve_id, keyword_search, cpe_name, cwe_id, CVSS severity, publication dates, modification dates, and KEV flags.';
    protected const METHOD = 'cves';
    protected const PARAMETERS = [
        'cve_id' => ['type' => 'string', 'required' => false, 'description' => 'CVE identifier such as CVE-2024-12345.'],
        'keyword_search' => ['type' => 'string', 'required' => false, 'description' => 'Keyword text searched across CVE data.'],
        'keyword_exact_match' => ['type' => 'boolean', 'required' => false, 'description' => 'Send the exact-match flag when true.'],
        'cpe_name' => ['type' => 'string', 'required' => false, 'description' => 'CPE 2.3 formatted name.'],
        'cwe_id' => ['type' => 'string', 'required' => false, 'description' => 'CWE identifier such as CWE-79.'],
        'cvss_v3_severity' => ['type' => 'string', 'required' => false, 'description' => 'CVSS v3 severity.', 'enum' => ['LOW', 'MEDIUM', 'HIGH', 'CRITICAL']],
        'cvss_v4_severity' => ['type' => 'string', 'required' => false, 'description' => 'CVSS v4 severity.', 'enum' => ['LOW', 'MEDIUM', 'HIGH', 'CRITICAL']],
        'has_kev' => ['type' => 'boolean', 'required' => false, 'description' => 'Send the Known Exploited Vulnerabilities flag when true.'],
        'no_rejected' => ['type' => 'boolean', 'required' => false, 'description' => 'Send the noRejected flag when true.'],
        'pub_start_date' => ['type' => 'string', 'required' => false, 'description' => 'Publication start timestamp in NVD ISO-8601 format.'],
        'pub_end_date' => ['type' => 'string', 'required' => false, 'description' => 'Publication end timestamp in NVD ISO-8601 format.'],
        'last_mod_start_date' => ['type' => 'string', 'required' => false, 'description' => 'Last-modified start timestamp.'],
        'last_mod_end_date' => ['type' => 'string', 'required' => false, 'description' => 'Last-modified end timestamp.'],
        'results_per_page' => ['type' => 'integer', 'required' => false, 'description' => 'Page size.'],
        'start_index' => ['type' => 'integer', 'required' => false, 'description' => 'Pagination start index.'],
    ];
}
