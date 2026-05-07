<?php

namespace OpenCompany\Integrations\Nvd\Tools;

/**
 * Search NVD CPE dictionary records.
 */
class NvdCpes extends AbstractNvdTool
{
    protected const NAME = 'nvd_cpes';
    protected const DESCRIPTION = 'Search NVD CPE dictionary records by keyword, cpeNameId, CPE match string, matchCriteriaId, modification dates, and pagination.';
    protected const METHOD = 'cpes';
    protected const PARAMETERS = [
        'cpe_name_id' => ['type' => 'string', 'required' => false, 'description' => 'CPE name UUID.'],
        'cpe_match_string' => ['type' => 'string', 'required' => false, 'description' => 'CPE 2.3 formatted match string.'],
        'keyword_search' => ['type' => 'string', 'required' => false, 'description' => 'Keyword text searched across CPE titles and names.'],
        'keyword_exact_match' => ['type' => 'boolean', 'required' => false, 'description' => 'Send the exact-match flag when true.'],
        'last_mod_start_date' => ['type' => 'string', 'required' => false, 'description' => 'Last-modified start timestamp.'],
        'last_mod_end_date' => ['type' => 'string', 'required' => false, 'description' => 'Last-modified end timestamp.'],
        'match_criteria_id' => ['type' => 'string', 'required' => false, 'description' => 'CPE match criteria UUID.'],
        'results_per_page' => ['type' => 'integer', 'required' => false, 'description' => 'Page size.'],
        'start_index' => ['type' => 'integer', 'required' => false, 'description' => 'Pagination start index.'],
    ];
}
