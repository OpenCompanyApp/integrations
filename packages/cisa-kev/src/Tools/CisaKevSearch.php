<?php

namespace OpenCompany\Integrations\CisaKev\Tools;

/**
 * Search and filter CISA KEV vulnerabilities client-side.
 */
class CisaKevSearch extends AbstractCisaKevTool
{
    protected const NAME = 'cisa_kev_search';
    protected const DESCRIPTION = 'Search the CISA KEV catalog by CVE, vendor, product, text, CWE, ransomware usage, date ranges, and pagination.';
    protected const METHOD = 'search';
    protected const PARAMETERS = [
        'cve_id' => ['type' => 'string', 'required' => false, 'description' => 'Exact CVE ID.'],
        'vendor' => ['type' => 'string', 'required' => false, 'description' => 'Case-insensitive vendor/project substring.'],
        'product' => ['type' => 'string', 'required' => false, 'description' => 'Case-insensitive product substring.'],
        'q' => ['type' => 'string', 'required' => false, 'description' => 'Case-insensitive text search across the entry.'],
        'cwe' => ['type' => 'string', 'required' => false, 'description' => 'Exact CWE ID such as CWE-787.'],
        'known_ransomware_campaign_use' => ['type' => 'string', 'required' => false, 'description' => 'Exact CISA ransomware usage value.', 'enum' => ['Known', 'Unknown']],
        'date_added_from' => ['type' => 'string', 'required' => false, 'description' => 'Minimum dateAdded in YYYY-MM-DD format.'],
        'date_added_to' => ['type' => 'string', 'required' => false, 'description' => 'Maximum dateAdded in YYYY-MM-DD format.'],
        'due_date_from' => ['type' => 'string', 'required' => false, 'description' => 'Minimum dueDate in YYYY-MM-DD format.'],
        'due_date_to' => ['type' => 'string', 'required' => false, 'description' => 'Maximum dueDate in YYYY-MM-DD format.'],
        'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum results to return, capped at 500.'],
        'offset' => ['type' => 'integer', 'required' => false, 'description' => 'Pagination offset.'],
    ];
}
