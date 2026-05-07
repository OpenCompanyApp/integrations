<?php

namespace OpenCompany\Integrations\FirstEpss\Tools;

/**
 * Get EPSS score for one CVE.
 */
class FirstEpssCve extends AbstractFirstEpssTool
{
    protected const NAME = 'first_epss_cve';
    protected const DESCRIPTION = 'Get the EPSS probability and percentile for one CVE, optionally on a specific date.';
    protected const METHOD = 'cve';
    protected const REQUIRED = ['cve'];
    protected const PARAMETERS = [
        'cve' => ['type' => 'string', 'required' => true, 'description' => 'CVE ID such as CVE-2022-27225.'],
        'date' => ['type' => 'string', 'required' => false, 'description' => 'Score date in YYYY-MM-DD format.'],
    ];
}
