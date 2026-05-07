<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Delete Story Link.
 *
 * Maps to the official Shortcut endpoint DELETE /api/v3/story-links/{story-link-public-id}.
 */
class ShortcutDeleteStoryLink extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_delete_story_link';
    protected const DESCRIPTION = 'Delete Story Link

Official Shortcut endpoint: DELETE /api/v3/story-links/{story-link-public-id}.';
    protected const PARAMETERS = [
        'story_link_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The unique ID of the Story Link.',
        ],
    ];
    protected const METHOD = 'DELETE';
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
