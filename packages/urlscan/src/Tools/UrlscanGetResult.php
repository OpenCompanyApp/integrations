<?php

namespace OpenCompany\Integrations\Urlscan\Tools;

/**
 * Result.
 *
 * Maps to the official urlscan.io endpoint GET /api/v1/result/{scanId}/.
 */
class UrlscanGetResult extends AbstractUrlscanTool
{
    protected const NAME = 'urlscan_get_result';
    protected const DESCRIPTION = 'Result

Official urlscan.io endpoint: GET /api/v1/result/{scanId}/.';
    protected const PARAMETERS = [
        'scan_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'UUID of scan result',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/result/{scanId}/';
    protected const PATH_PARAMS = [
        'scanId' => 'scan_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
}
