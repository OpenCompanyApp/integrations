<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Get Story Link.
 *
 * Maps to the official Shortcut endpoint GET /api/v3/story-links/{story-link-public-id}.
 */
class ShortcutGetStoryLink extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_get_story_link';
    protected const DESCRIPTION = 'Get Story Link

Official Shortcut endpoint: GET /api/v3/story-links/{story-link-public-id}.';
    protected const PARAMETERS = [
        'story_link_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The unique ID of the Story Link.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/story-links/{story-link-public-id}';
    protected const PATH_PARAMS = [
        'story-link-public-id' => 'story_link_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
