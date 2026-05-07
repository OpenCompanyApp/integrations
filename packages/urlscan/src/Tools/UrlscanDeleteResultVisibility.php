<?php

namespace OpenCompany\Integrations\Urlscan\Tools;

/**
 * Reset to original visibility.
 *
 * Maps to the official urlscan.io endpoint DELETE /api/v1/result/{scanId}/visibility/.
 */
class UrlscanDeleteResultVisibility extends AbstractUrlscanTool
{
    protected const NAME = 'urlscan_delete_result_visibility';
    protected const DESCRIPTION = 'Reset to original visibility

Official urlscan.io endpoint: DELETE /api/v1/result/{scanId}/visibility/.';
    protected const PARAMETERS = [
        'scan_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'UUID of scan result',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v1/result/{scanId}/visibility/';
    protected const PATH_PARAMS = [
        'scanId' => 'scan_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
}
