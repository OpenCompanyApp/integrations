<?php

namespace OpenCompany\Integrations\Urlscan\Tools;

/**
 * Saved Searches.
 *
 * Maps to the official urlscan.io endpoint GET /api/v1/user/searches/.
 */
class UrlscanListSavedSearches extends AbstractUrlscanTool
{
    protected const NAME = 'urlscan_list_saved_searches';
    protected const DESCRIPTION = 'Saved Searches

Official urlscan.io endpoint: GET /api/v1/user/searches/.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/user/searches/';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
}
