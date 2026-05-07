<?php

namespace OpenCompany\Integrations\Urlscan\Tools;

/**
 * Search.
 *
 * Maps to the official urlscan.io endpoint GET /api/v1/search.
 */
class UrlscanSearchDatasource extends AbstractUrlscanTool
{
    protected const NAME = 'urlscan_search_datasource';
    protected const DESCRIPTION = 'Search

Official urlscan.io endpoint: GET /api/v1/search.';
    protected const PARAMETERS = [
        'q' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Search Query (Elasticsearch Query String)',
        ],
        'size' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Number of results to return',
        ],
        'search_after' => [
            'type' => 'string',
            'required' => false,
            'description' => 'For retrieving the next batch of results, send the value of the `sort` attribute of the last (oldest) result you received (comma-separated) from the previous call.',
        ],
        'datasource' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Datasources to search: scans (urlscan.io), hostnames, incidents, notifications, certificates (urlscan Pro)',
            'enum' => ['scans', 'hostnames', 'incidents', 'notifications', 'certificates'],
        ],
        'collapse' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Field to collapse results on. Only works on current page of results.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/search';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'q' => 'q',
        'size' => 'size',
        'search_after' => 'search_after',
        'datasource' => 'datasource',
        'collapse' => 'collapse',
    ];
    protected const BODY_REQUIRED = false;
}
