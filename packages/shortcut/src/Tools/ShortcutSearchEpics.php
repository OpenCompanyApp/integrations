<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Search Epics.
 *
 * Maps to the official Shortcut endpoint GET /api/v3/search/epics.
 */
class ShortcutSearchEpics extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_search_epics';
    protected const DESCRIPTION = 'Search Epics

Official Shortcut endpoint: GET /api/v3/search/epics.';
    protected const PARAMETERS = [
        'query' => [
            'type' => 'string',
            'required' => true,
            'description' => 'See our help center article on [search operators](https://help.shortcut.com/hc/en-us/articles/360000046646-Search-Operators)',
        ],
        'page_size' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'The number of search results to include in a page. Minimum of 1 and maximum of 250.',
        ],
        'detail' => [
            'type' => 'string',
            'required' => false,
            'description' => 'The amount of detail included in each result item. "full" will include all descriptions and comments and more fields on related items such as pull requests, branches and tasks. "slim" omits larger fulltext fields such as descriptions and comments and only references related items by id. The default is "full".',
            'enum' => [
                'full',
                'slim',
            ],
        ],
        'next' => [
            'type' => 'string',
            'required' => false,
            'description' => 'The next page token.',
        ],
        'entity_types' => [
            'type' => 'array',
            'required' => false,
            'description' => 'A collection of entity_types to search. Defaults to story and epic. Supports: epic, iteration, objective, story.',
            'items' => [
                'type' => 'string',
            ],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/search/epics';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'query' => 'query',
        'page_size' => 'page_size',
        'detail' => 'detail',
        'next' => 'next',
        'entity_types' => 'entity_types',
    ];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
