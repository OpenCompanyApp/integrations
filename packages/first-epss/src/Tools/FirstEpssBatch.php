<?php

namespace OpenCompany\Integrations\FirstEpss\Tools;

/**
 * Get EPSS scores for multiple CVEs.
 */
class FirstEpssBatch extends AbstractFirstEpssTool
{
    protected const NAME = 'first_epss_batch';
    protected const DESCRIPTION = 'Get EPSS scores for a list of CVEs, optionally on a specific date.';
    protected const METHOD = 'batch';
    protected const REQUIRED = ['cves'];
    protected const PARAMETERS = [
        'cves' => ['type' => 'array', 'required' => true, 'description' => 'CVE identifiers.', 'items' => ['type' => 'string']],
        'date' => ['type' => 'string', 'required' => false, 'description' => 'Score date in YYYY-MM-DD format.'],
    ];
}
