<?php

namespace OpenCompany\Integrations\FirstEpss\Tools;

/**
 * Get EPSS time-series scores for one CVE.
 */
class FirstEpssTimeSeries extends AbstractFirstEpssTool
{
    protected const NAME = 'first_epss_time_series';
    protected const DESCRIPTION = 'Get EPSS time-series scores for one CVE. If date is supplied, the series runs up to that date.';
    protected const METHOD = 'timeSeries';
    protected const REQUIRED = ['cve'];
    protected const PARAMETERS = [
        'cve' => ['type' => 'string', 'required' => true, 'description' => 'CVE ID such as CVE-2022-25204.'],
        'date' => ['type' => 'string', 'required' => false, 'description' => 'End date in YYYY-MM-DD format.'],
    ];
}
