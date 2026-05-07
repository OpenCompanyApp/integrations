<?php

namespace OpenCompany\Integrations\FirstEpss\Tools;

/**
 * Run a general FIRST EPSS query.
 */
class FirstEpssQuery extends AbstractFirstEpssTool
{
    protected const NAME = 'first_epss_query';
    protected const DESCRIPTION = 'Run a general FIRST EPSS API query with official parameters.';
    protected const METHOD = 'query';
    protected const PARAMETERS = [
        'cve' => ['type' => 'string', 'required' => false, 'description' => 'Single CVE or comma-separated CVE list.'],
        'cves' => ['type' => 'array', 'required' => false, 'description' => 'CVE identifiers to send as a comma-separated cve parameter.', 'items' => ['type' => 'string']],
        'date' => ['type' => 'string', 'required' => false, 'description' => 'Score date in YYYY-MM-DD format.'],
        'scope' => ['type' => 'string', 'required' => false, 'description' => 'Use time-series for CVE history.', 'enum' => ['time-series']],
        'epss_gt' => ['type' => 'number', 'required' => false, 'description' => 'Minimum EPSS probability threshold.'],
        'percentile_gt' => ['type' => 'number', 'required' => false, 'description' => 'Minimum EPSS percentile threshold.'],
        'order' => ['type' => 'string', 'required' => false, 'description' => 'FIRST ordering value, e.g. !epss or !percentile.'],
        'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum records to return.'],
        'offset' => ['type' => 'integer', 'required' => false, 'description' => 'Pagination offset.'],
        'fields' => ['type' => 'string', 'required' => false, 'description' => 'Comma-separated fields to return.'],
    ];
}
