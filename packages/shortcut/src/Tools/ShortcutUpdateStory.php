<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Update Story.
 *
 * Maps to the official Shortcut endpoint PUT /api/v3/stories/{story-public-id}.
 */
class ShortcutUpdateStory extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_update_story';
    protected const DESCRIPTION = 'Update Story

Official Shortcut endpoint: PUT /api/v3/stories/{story-public-id}.';
    protected const PARAMETERS = [
        'story_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The unique identifier of this story.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Shortcut API schema.',
        ],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/api/v3/stories/{story-public-id}';
    protected const PATH_PARAMS = [
        'story-public-id' => 'story_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}
