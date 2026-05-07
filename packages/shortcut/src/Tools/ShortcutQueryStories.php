<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Query Stories.
 *
 * Maps to the official Shortcut endpoint POST /api/v3/stories/search.
 */
class ShortcutQueryStories extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_query_stories';
    protected const DESCRIPTION = 'Query Stories

Official Shortcut endpoint: POST /api/v3/stories/search.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Shortcut API schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v3/stories/search';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}
