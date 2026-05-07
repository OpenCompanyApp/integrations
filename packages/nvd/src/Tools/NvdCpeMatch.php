<?php

namespace OpenCompany\Integrations\Nvd\Tools;

/**
 * Search NVD CPE match criteria records.
 */
class NvdCpeMatch extends AbstractNvdTool
{
    protected const NAME = 'nvd_cpe_match';
    protected const DESCRIPTION = 'Search NVD CPE match criteria records by CVE ID, matchCriteriaId, match string, modification dates, and pagination.';
    protected const METHOD = 'cpeMatch';
    protected const PARAMETERS = [
        'cve_id' => ['type' => 'string', 'required' => false, 'description' => 'CVE identifier associated with criteria.'],
        'match_criteria_id' => ['type' => 'string', 'required' => false, 'description' => 'CPE match criteria UUID.'],
        'match_string_search' => ['type' => 'string', 'required' => false, 'description' => 'CPE match string search text.'],
        'last_mod_start_date' => ['type' => 'string', 'required' => false, 'description' => 'Last-modified start timestamp.'],
        'last_mod_end_date' => ['type' => 'string', 'required' => false, 'description' => 'Last-modified end timestamp.'],
        'results_per_page' => ['type' => 'integer', 'required' => false, 'description' => 'Page size.'],
        'start_index' => ['type' => 'integer', 'required' => false, 'description' => 'Pagination start index.'],
    ];
}
