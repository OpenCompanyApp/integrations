<?php

namespace OpenCompany\Integrations\Urlscan\Tools;

/**
 * Purge Live Scan Result.
 *
 * Maps to the official urlscan.io endpoint DELETE /api/v1/livescan/{scannerId}/{scanId}/.
 */
class UrlscanDiscardLivescanResult extends AbstractUrlscanTool
{
    protected const NAME = 'urlscan_discard_livescan_result';
    protected const DESCRIPTION = 'Purge Live Scan Result

Official urlscan.io endpoint: DELETE /api/v1/livescan/{scannerId}/{scanId}/.';
    protected const PARAMETERS = [
        'scanner_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'scannerId',
        ],
        'scan_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'scanId',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v1/livescan/{scannerId}/{scanId}/';
    protected const PATH_PARAMS = [
        'scannerId' => 'scanner_id',
        'scanId' => 'scan_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
}
