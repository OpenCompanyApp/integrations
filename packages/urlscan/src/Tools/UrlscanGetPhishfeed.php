<?php

namespace OpenCompany\Integrations\Urlscan\Tools;

/**
 * Phishfeed.
 *
 * Maps to the official urlscan.io endpoint GET /api/v1/pro/phishfeed.
 */
class UrlscanGetPhishfeed extends AbstractUrlscanTool
{
    protected const NAME = 'urlscan_get_phishfeed';
    protected const DESCRIPTION = 'Phishfeed

Official urlscan.io endpoint: GET /api/v1/pro/phishfeed.';
    protected const PARAMETERS = [
        'q' => [
            'type' => 'string',
            'required' => false,
            'description' => 'q',
        ],
        'limit' => [
            'type' => 'number',
            'required' => false,
            'description' => 'How many results to return',
        ],
        'format' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Can be one of csv, tsv, or json',
            'enum' => ['csv', 'tsv', 'json'],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/pro/phishfeed';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'q' => 'q',
        'limit' => 'limit',
        'format' => 'format',
    ];
    protected const BODY_REQUIRED = false;
}
