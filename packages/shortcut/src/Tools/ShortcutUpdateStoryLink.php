<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Update Story Link.
 *
 * Maps to the official Shortcut endpoint PUT /api/v3/story-links/{story-link-public-id}.
 */
class ShortcutUpdateStoryLink extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_update_story_link';
    protected const DESCRIPTION = 'Update Story Link

Official Shortcut endpoint: PUT /api/v3/story-links/{story-link-public-id}.';
    protected const PARAMETERS = [
        'story_link_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The unique ID of the Story Link.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Shortcut API schema.',
        ],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/api/v3/story-links/{story-link-public-id}';
    protected const PATH_PARAMS = [
        'story-link-public-id' => 'story_link_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}
