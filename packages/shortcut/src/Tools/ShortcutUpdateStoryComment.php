<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Update Story Comment.
 *
 * Maps to the official Shortcut endpoint PUT /api/v3/stories/{story-public-id}/comments/{comment-public-id}.
 */
class ShortcutUpdateStoryComment extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_update_story_comment';
    protected const DESCRIPTION = 'Update Story Comment

Official Shortcut endpoint: PUT /api/v3/stories/{story-public-id}/comments/{comment-public-id}.';
    protected const PARAMETERS = [
        'story_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The ID of the Story that the Comment is in.',
        ],
        'comment_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The ID of the Comment',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Shortcut API schema.',
        ],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/api/v3/stories/{story-public-id}/comments/{comment-public-id}';
    protected const PATH_PARAMS = [
        'story-public-id' => 'story_public_id',
        'comment-public-id' => 'comment_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}
