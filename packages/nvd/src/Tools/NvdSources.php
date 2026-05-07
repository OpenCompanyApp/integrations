<?php

namespace OpenCompany\Integrations\Nvd\Tools;

/**
 * Search NVD data-source metadata.
 */
class NvdSources extends AbstractNvdTool
{
    protected const NAME = 'nvd_sources';
    protected const DESCRIPTION = 'Search NVD data-source metadata by sourceIdentifier, modification dates, and pagination.';
    protected const METHOD = 'sources';
    protected const PARAMETERS = [
        'source_identifier' => ['type' => 'string', 'required' => false, 'description' => 'NVD source identifier, often an email-like CNA identifier.'],
        'last_mod_start_date' => ['type' => 'string', 'required' => false, 'description' => 'Last-modified start timestamp.'],
        'last_mod_end_date' => ['type' => 'string', 'required' => false, 'description' => 'Last-modified end timestamp.'],
        'results_per_page' => ['type' => 'integer', 'required' => false, 'description' => 'Page size.'],
        'start_index' => ['type' => 'integer', 'required' => false, 'description' => 'Pagination start index.'],
    ];
}
