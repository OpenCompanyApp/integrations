<?php

namespace OpenCompany\Integrations\FirstEpss\Tools;

/**
 * Return the official historical EPSS daily CSV gzip URL.
 */
class FirstEpssHistoricalCsvUrl extends AbstractFirstEpssTool
{
    protected const NAME = 'first_epss_historical_csv_url';
    protected const DESCRIPTION = 'Return the official historical EPSS daily CSV gzip URL for a date. The tool does not download the large file.';
    protected const METHOD = 'historicalCsvUrl';
    protected const REQUIRED = ['date'];
    protected const PARAMETERS = [
        'date' => ['type' => 'string', 'required' => true, 'description' => 'Historical score date in YYYY-MM-DD format.'],
    ];
}
