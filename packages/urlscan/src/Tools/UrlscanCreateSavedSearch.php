<?php

namespace OpenCompany\Integrations\Urlscan\Tools;

/**
 * Create Saved Search.
 *
 * Maps to the official urlscan.io endpoint POST /api/v1/user/searches/.
 */
class UrlscanCreateSavedSearch extends AbstractUrlscanTool
{
    protected const NAME = 'urlscan_create_saved_search';
    protected const DESCRIPTION = 'Create Saved Search

Official urlscan.io endpoint: POST /api/v1/user/searches/.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'JSON request body matching the official urlscan.io OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/user/searches/';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
}
