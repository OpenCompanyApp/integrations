<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Delete Multiple Stories.
 *
 * Maps to the official Shortcut endpoint DELETE /api/v3/stories/bulk.
 */
class ShortcutDeleteMultipleStories extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_delete_multiple_stories';
    protected const DESCRIPTION = 'Delete Multiple Stories

Official Shortcut endpoint: DELETE /api/v3/stories/bulk.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Shortcut API schema.',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v3/stories/bulk';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}
