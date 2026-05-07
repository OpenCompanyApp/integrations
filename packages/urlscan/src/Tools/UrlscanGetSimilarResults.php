<?php

namespace OpenCompany\Integrations\Urlscan\Tools;

/**
 * Structure Search.
 *
 * Maps to the official urlscan.io endpoint GET /api/v1/pro/result/{scanId}/similar/.
 */
class UrlscanGetSimilarResults extends AbstractUrlscanTool
{
    protected const NAME = 'urlscan_get_similar_results';
    protected const DESCRIPTION = 'Structure Search

Official urlscan.io endpoint: GET /api/v1/pro/result/{scanId}/similar/.';
    protected const PARAMETERS = [
        'q' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Additional query filter',
        ],
        'size' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Maximum results per call',
        ],
        'search_after' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Parameter to iterate over older results',
        ],
        'scan_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The original scan to compare to',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/pro/result/{scanId}/similar/';
    protected const PATH_PARAMS = [
        'scanId' => 'scan_id',
    ];
    protected const QUERY_PARAMS = [
        'q' => 'q',
        'size' => 'size',
        'search_after' => 'search_after',
    ];
    protected const BODY_REQUIRED = false;
}
