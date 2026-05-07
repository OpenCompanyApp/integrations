<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * List Story Sub tasks.
 *
 * Maps to the official Shortcut endpoint GET /api/v3/stories/{story-public-id}/sub-tasks.
 */
class ShortcutListStorySubTasks extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_list_story_sub_tasks';
    protected const DESCRIPTION = 'List Story Sub tasks

Official Shortcut endpoint: GET /api/v3/stories/{story-public-id}/sub-tasks.';
    protected const PARAMETERS = [
        'story_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The ID of the Story.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/stories/{story-public-id}/sub-tasks';
    protected const PATH_PARAMS = [
        'story-public-id' => 'story_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
