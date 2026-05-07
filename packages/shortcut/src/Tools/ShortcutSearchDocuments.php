<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Search Documents.
 *
 * Maps to the official Shortcut endpoint GET /api/v3/search/documents.
 */
class ShortcutSearchDocuments extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_search_documents';
    protected const DESCRIPTION = 'Search Documents

Official Shortcut endpoint: GET /api/v3/search/documents.';
    protected const PARAMETERS = [
        'title' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Search text to match against document titles. Supports fuzzy matching. Required.',
        ],
        'archived' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'When true, find archived documents. When false, find non-archived documents.',
        ],
        'created_by_me' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'When true, find documents created by the current user. When false, find documents NOT created by current user.',
        ],
        'followed_by_me' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'When true, find documents that the current user is following. When false, find documents NOT followed.',
        ],
        'page_size' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'The number of search results to include in a page. Minimum of 1 and maximum of 250.',
        ],
        'next' => [
            'type' => 'string',
            'required' => false,
            'description' => 'The next page token.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/search/documents';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'title' => 'title',
        'archived' => 'archived',
        'created_by_me' => 'created_by_me',
        'followed_by_me' => 'followed_by_me',
        'page_size' => 'page_size',
        'next' => 'next',
    ];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
