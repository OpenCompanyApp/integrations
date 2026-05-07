<?php

namespace OpenCompany\Integrations\Urlscan\Tools;

/**
 * Saved Search Search Results.
 *
 * Maps to the official urlscan.io endpoint GET /api/v1/user/searches/{searchId}/results/.
 */
class UrlscanGetSavedSearchResults extends AbstractUrlscanTool
{
    protected const NAME = 'urlscan_get_saved_search_results';
    protected const DESCRIPTION = 'Saved Search Search Results

Official urlscan.io endpoint: GET /api/v1/user/searches/{searchId}/results/.';
    protected const PARAMETERS = [
        'search_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'searchId',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/user/searches/{searchId}/results/';
    protected const PATH_PARAMS = [
        'searchId' => 'search_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
}
