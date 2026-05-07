<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Delete Task.
 *
 * Maps to the official Shortcut endpoint DELETE /api/v3/stories/{story-public-id}/tasks/{task-public-id}.
 */
class ShortcutDeleteTask extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_delete_task';
    protected const DESCRIPTION = 'Delete Task

Official Shortcut endpoint: DELETE /api/v3/stories/{story-public-id}/tasks/{task-public-id}.';
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
    protected const METHOD = 'DELETE';
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
