<?php

namespace OpenCompany\Integrations\FirstEpss\Tools;

/**
 * List highest scoring EPSS CVEs.
 */
class FirstEpssTop extends AbstractFirstEpssTool
{
    protected const NAME = 'first_epss_top';
    protected const DESCRIPTION = 'List top CVEs ordered by descending EPSS probability or percentile.';
    protected const METHOD = 'top';
    protected const PARAMETERS = [
        'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum records to return. Defaults to 100.'],
        'by' => ['type' => 'string', 'required' => false, 'description' => 'Ordering field.', 'enum' => ['epss', 'percentile']],
        'date' => ['type' => 'string', 'required' => false, 'description' => 'Score date in YYYY-MM-DD format.'],
    ];
}
