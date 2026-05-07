<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Update Task.
 *
 * Maps to the official Shortcut endpoint PUT /api/v3/stories/{story-public-id}/tasks/{task-public-id}.
 */
class ShortcutUpdateTask extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_update_task';
    protected const DESCRIPTION = 'Update Task

Official Shortcut endpoint: PUT /api/v3/stories/{story-public-id}/tasks/{task-public-id}.';
    protected const PARAMETERS = [
        'story_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The unique identifier of the parent Story.',
        ],
        'task_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The unique identifier of the Task you wish to update.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Shortcut API schema.',
        ],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/api/v3/stories/{story-public-id}/tasks/{task-public-id}';
    protected const PATH_PARAMS = [
        'story-public-id' => 'story_public_id',
        'task-public-id' => 'task_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}
