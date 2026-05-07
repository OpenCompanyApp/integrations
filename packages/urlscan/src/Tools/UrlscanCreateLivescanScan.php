<?php

namespace OpenCompany\Integrations\Urlscan\Tools;

/**
 * Trigger Live Scan.
 *
 * Maps to the official urlscan.io endpoint POST /api/v1/livescan/{scannerId}/scan/.
 */
class UrlscanCreateLivescanScan extends AbstractUrlscanTool
{
    protected const NAME = 'urlscan_create_livescan_scan';
    protected const DESCRIPTION = 'Trigger Live Scan

Official urlscan.io endpoint: POST /api/v1/livescan/{scannerId}/scan/.';
    protected const PARAMETERS = [
        'scanner_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'scannerId',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'JSON request body matching the official urlscan.io OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/livescan/{scannerId}/scan/';
    protected const PATH_PARAMS = [
        'scannerId' => 'scanner_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
}
