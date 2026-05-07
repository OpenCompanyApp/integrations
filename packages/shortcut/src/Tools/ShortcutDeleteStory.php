<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Delete Story.
 *
 * Maps to the official Shortcut endpoint DELETE /api/v3/stories/{story-public-id}.
 */
class ShortcutDeleteStory extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_delete_story';
    protected const DESCRIPTION = 'Delete Story

Official Shortcut endpoint: DELETE /api/v3/stories/{story-public-id}.';
    protected const PARAMETERS = [
        'story_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The ID of the Story.',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v3/stories/{story-public-id}';
    protected const PATH_PARAMS = [
        'story-public-id' => 'story_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
