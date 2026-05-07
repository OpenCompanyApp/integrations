<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Get Task.
 *
 * Maps to the official Shortcut endpoint GET /api/v3/stories/{story-public-id}/tasks/{task-public-id}.
 */
class ShortcutGetTask extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_get_task';
    protected const DESCRIPTION = 'Get Task

Official Shortcut endpoint: GET /api/v3/stories/{story-public-id}/tasks/{task-public-id}.';
    protected const PARAMETERS = [
        'story_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The unique ID of the Story this Task is associated with.',
        ],
        'task_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The unique ID of the Task.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/stories/{story-public-id}/tasks/{task-public-id}';
    protected const PATH_PARAMS = [
        'story-public-id' => 'story_public_id',
        'task-public-id' => 'task_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
