<?php

namespace OpenCompany\Integrations\Urlscan\Tools;

/**
 * Store Live Scan Result.
 *
 * Maps to the official urlscan.io endpoint PUT /api/v1/livescan/{scannerId}/{scanId}/.
 */
class UrlscanStoreLivescanResult extends AbstractUrlscanTool
{
    protected const NAME = 'urlscan_store_livescan_result';
    protected const DESCRIPTION = 'Store Live Scan Result

Official urlscan.io endpoint: PUT /api/v1/livescan/{scannerId}/{scanId}/.';
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
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'JSON request body matching the official urlscan.io OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/api/v1/livescan/{scannerId}/{scanId}/';
    protected const PATH_PARAMS = [
        'scannerId' => 'scanner_id',
        'scanId' => 'scan_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
}
