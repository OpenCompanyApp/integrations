<?php

namespace OpenCompany\Integrations\Urlscan\Tools;

/**
 * Delete Saved Search.
 *
 * Maps to the official urlscan.io endpoint DELETE /api/v1/user/searches/{searchId}/.
 */
class UrlscanDeleteSavedSearch extends AbstractUrlscanTool
{
    protected const NAME = 'urlscan_delete_saved_search';
    protected const DESCRIPTION = 'Delete Saved Search

Official urlscan.io endpoint: DELETE /api/v1/user/searches/{searchId}/.';
    protected const PARAMETERS = [
        'search_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'searchId',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v1/user/searches/{searchId}/';
    protected const PATH_PARAMS = [
        'searchId' => 'search_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
}
