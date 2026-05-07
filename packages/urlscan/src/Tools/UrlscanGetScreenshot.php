<?php

namespace OpenCompany\Integrations\Urlscan\Tools;

/**
 * Screenshot.
 *
 * Maps to the official urlscan.io endpoint GET /screenshots/{scanId}.png.
 */
class UrlscanGetScreenshot extends AbstractUrlscanTool
{
    protected const NAME = 'urlscan_get_screenshot';
    protected const DESCRIPTION = 'Screenshot

Official urlscan.io endpoint: GET /screenshots/{scanId}.png.';
    protected const PARAMETERS = [
        'scan_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'UUID of scan result',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/screenshots/{scanId}.png';
    protected const PATH_PARAMS = [
        'scanId' => 'scan_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
}
