<?php

namespace OpenCompany\Integrations\Nvd\Tools;

/**
 * Search NVD CVE change-history events.
 */
class NvdCveHistory extends AbstractNvdTool
{
    protected const NAME = 'nvd_cve_history';
    protected const DESCRIPTION = 'Search NVD CVE change-history events by CVE ID, event name, change date range, and pagination.';
    protected const METHOD = 'cveHistory';
    protected const PARAMETERS = [
        'cve_id' => ['type' => 'string', 'required' => false, 'description' => 'CVE identifier to inspect.'],
        'event_name' => ['type' => 'string', 'required' => false, 'description' => 'NVD change event name.'],
        'change_start_date' => ['type' => 'string', 'required' => false, 'description' => 'Change start timestamp.'],
        'change_end_date' => ['type' => 'string', 'required' => false, 'description' => 'Change end timestamp.'],
        'results_per_page' => ['type' => 'integer', 'required' => false, 'description' => 'Page size.'],
        'start_index' => ['type' => 'integer', 'required' => false, 'description' => 'Pagination start index.'],
    ];
}
