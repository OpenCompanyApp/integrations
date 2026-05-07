<?php

namespace OpenCompany\Integrations\Urlscan\Tools;

/**
 * Scan.
 *
 * Maps to the official urlscan.io endpoint POST /api/v1/scan.
 */
class UrlscanSubmitScan extends AbstractUrlscanTool
{
    protected const NAME = 'urlscan_submit_scan';
    protected const DESCRIPTION = 'Scan

Official urlscan.io endpoint: POST /api/v1/scan.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'JSON request body matching the official urlscan.io OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/scan';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = true;
}
