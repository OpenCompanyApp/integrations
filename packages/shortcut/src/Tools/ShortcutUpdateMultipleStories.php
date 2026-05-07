<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Update Multiple Stories.
 *
 * Maps to the official Shortcut endpoint PUT /api/v3/stories/bulk.
 */
class ShortcutUpdateMultipleStories extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_update_multiple_stories';
    protected const DESCRIPTION = 'Update Multiple Stories

Official Shortcut endpoint: PUT /api/v3/stories/bulk.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Shortcut API schema.',
        ],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/api/v3/stories/bulk';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}
