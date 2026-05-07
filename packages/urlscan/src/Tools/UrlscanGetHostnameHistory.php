<?php

namespace OpenCompany\Integrations\Urlscan\Tools;

/**
 * Hostname History.
 *
 * Maps to the official urlscan.io endpoint GET /api/v1/hostname/{hostname}.
 */
class UrlscanGetHostnameHistory extends AbstractUrlscanTool
{
    protected const NAME = 'urlscan_get_hostname_history';
    protected const DESCRIPTION = 'Hostname History

Official urlscan.io endpoint: GET /api/v1/hostname/{hostname}.';
    protected const PARAMETERS = [
        'hostname' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The hostname to query',
        ],
        'limit' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Return at most this many results. Minimum 10 Maximum 10000 Default 1000',
        ],
        'page_state' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Returns additional results starting from this page state from the previous API call.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/hostname/{hostname}';
    protected const PATH_PARAMS = [
        'hostname' => 'hostname',
    ];
    protected const QUERY_PARAMS = [
        'limit' => 'limit',
        'pageState' => 'page_state',
    ];
    protected const BODY_REQUIRED = false;
}
