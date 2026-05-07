<?php

namespace OpenCompany\Integrations\Urlscan\Tools;

/**
 * DOM.
 *
 * Maps to the official urlscan.io endpoint GET /dom/{scanId}/.
 */
class UrlscanGetDom extends AbstractUrlscanTool
{
    protected const NAME = 'urlscan_get_dom';
    protected const DESCRIPTION = 'DOM

Official urlscan.io endpoint: GET /dom/{scanId}/.';
    protected const PARAMETERS = [
        'scan_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'UUID of scan result',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/dom/{scanId}/';
    protected const PATH_PARAMS = [
        'scanId' => 'scan_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
}
