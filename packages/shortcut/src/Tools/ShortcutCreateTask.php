<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Create Task.
 *
 * Maps to the official Shortcut endpoint POST /api/v3/stories/{story-public-id}/tasks.
 */
class ShortcutCreateTask extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_create_task';
    protected const DESCRIPTION = 'Create Task

Official Shortcut endpoint: POST /api/v3/stories/{story-public-id}/tasks.';
    protected const PARAMETERS = [
        'story_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The ID of the Story that the Task will be in.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Shortcut API schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v3/stories/{story-public-id}/tasks';
    protected const PATH_PARAMS = [
        'story-public-id' => 'story_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}
