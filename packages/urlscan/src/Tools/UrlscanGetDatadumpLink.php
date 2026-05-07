<?php

namespace OpenCompany\Integrations\Urlscan\Tools;

/**
 * Get Data Dump Download Link.
 *
 * Maps to the official urlscan.io endpoint GET /api/v1/datadump/link/{path}.
 */
class UrlscanGetDatadumpLink extends AbstractUrlscanTool
{
    protected const NAME = 'urlscan_get_datadump_link';
    protected const DESCRIPTION = 'Get Data Dump Download Link

Official urlscan.io endpoint: GET /api/v1/datadump/link/{path}.';
    protected const PARAMETERS = [
        'path' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path of the data dump file',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/datadump/link/{path}';
    protected const PATH_PARAMS = [
        'path' => 'path',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
}
