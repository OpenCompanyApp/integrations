<?php

namespace OpenCompany\Integrations\Urlscan\Tools;

/**
 * Update Result Visibility.
 *
 * Maps to the official urlscan.io endpoint PUT /api/v1/result/{scanId}/visibility/.
 */
class UrlscanUpdateResultVisibility extends AbstractUrlscanTool
{
    protected const NAME = 'urlscan_update_result_visibility';
    protected const DESCRIPTION = 'Update Result Visibility

Official urlscan.io endpoint: PUT /api/v1/result/{scanId}/visibility/.';
    protected const PARAMETERS = [
        'scan_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'UUID of scan result',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'JSON request body matching the official urlscan.io OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/api/v1/result/{scanId}/visibility/';
    protected const PATH_PARAMS = [
        'scanId' => 'scan_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = true;
}
