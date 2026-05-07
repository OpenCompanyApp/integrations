<?php

namespace OpenCompany\Integrations\Urlscan\Tools;

/**
 * Live Scan Get Resource.
 *
 * Maps to the official urlscan.io endpoint GET /api/v1/livescan/{scannerId}/{resourceType}/{resourceId}.
 */
class UrlscanGetLivescanResource extends AbstractUrlscanTool
{
    protected const NAME = 'urlscan_get_livescan_resource';
    protected const DESCRIPTION = 'Live Scan Get Resource

Official urlscan.io endpoint: GET /api/v1/livescan/{scannerId}/{resourceType}/{resourceId}.';
    protected const PARAMETERS = [
        'scanner_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'scannerId',
        ],
        'resource_type' => [
            'type' => 'string',
            'required' => true,
            'description' => 'resourceType',
            'enum' => ['result', 'screenshot', 'dom', 'response', 'download'],
        ],
        'resource_id' => [
            'type' => 'string',
            'required' => true,
            'description' => '* For result, screenshot, dom: UUID of the scan * For response, download: The SHA256 of the resource',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/livescan/{scannerId}/{resourceType}/{resourceId}';
    protected const PATH_PARAMS = [
        'scannerId' => 'scanner_id',
        'resourceType' => 'resource_type',
        'resourceId' => 'resource_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
}
