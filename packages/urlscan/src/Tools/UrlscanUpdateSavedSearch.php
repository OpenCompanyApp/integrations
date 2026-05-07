<?php

namespace OpenCompany\Integrations\Urlscan\Tools;

/**
 * Update Saved Search.
 *
 * Maps to the official urlscan.io endpoint PUT /api/v1/user/searches/{searchId}/.
 */
class UrlscanUpdateSavedSearch extends AbstractUrlscanTool
{
    protected const NAME = 'urlscan_update_saved_search';
    protected const DESCRIPTION = 'Update Saved Search

Official urlscan.io endpoint: PUT /api/v1/user/searches/{searchId}/.';
    protected const PARAMETERS = [
        'search_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'searchId',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'JSON request body matching the official urlscan.io OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/api/v1/user/searches/{searchId}/';
    protected const PATH_PARAMS = [
        'searchId' => 'search_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
}
