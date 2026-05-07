<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Get Story Comment.
 *
 * Maps to the official Shortcut endpoint GET /api/v3/stories/{story-public-id}/comments/{comment-public-id}.
 */
class ShortcutGetStoryComment extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_get_story_comment';
    protected const DESCRIPTION = 'Get Story Comment

Official Shortcut endpoint: GET /api/v3/stories/{story-public-id}/comments/{comment-public-id}.';
    protected const PARAMETERS = [
        'story_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The ID of the Story that the Comment is in.',
        ],
        'comment_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The ID of the Comment.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/stories/{story-public-id}/comments/{comment-public-id}';
    protected const PATH_PARAMS = [
        'story-public-id' => 'story_public_id',
        'comment-public-id' => 'comment_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
