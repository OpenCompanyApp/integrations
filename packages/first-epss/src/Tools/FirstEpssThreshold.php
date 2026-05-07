<?php

namespace OpenCompany\Integrations\FirstEpss\Tools;

/**
 * List CVEs above EPSS probability or percentile thresholds.
 */
class FirstEpssThreshold extends AbstractFirstEpssTool
{
    protected const NAME = 'first_epss_threshold';
    protected const DESCRIPTION = 'List CVEs above an EPSS probability or percentile threshold.';
    protected const METHOD = 'threshold';
    protected const PARAMETERS = [
        'epss_gt' => ['type' => 'number', 'required' => false, 'description' => 'Minimum EPSS probability threshold, such as 0.95.'],
        'percentile_gt' => ['type' => 'number', 'required' => false, 'description' => 'Minimum percentile threshold, such as 0.95.'],
        'date' => ['type' => 'string', 'required' => false, 'description' => 'Score date in YYYY-MM-DD format.'],
        'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum records to return.'],
        'offset' => ['type' => 'integer', 'required' => false, 'description' => 'Pagination offset.'],
        'order' => ['type' => 'string', 'required' => false, 'description' => 'Optional ordering override.'],
    ];
}
