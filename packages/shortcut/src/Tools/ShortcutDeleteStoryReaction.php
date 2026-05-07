<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Delete Story Reaction.
 *
 * Maps to the official Shortcut endpoint DELETE /api/v3/stories/{story-public-id}/comments/{comment-public-id}/reactions.
 */
class ShortcutDeleteStoryReaction extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_delete_story_reaction';
    protected const DESCRIPTION = 'Delete Story Reaction

Official Shortcut endpoint: DELETE /api/v3/stories/{story-public-id}/comments/{comment-public-id}/reactions.';
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
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Shortcut API schema.',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v3/stories/{story-public-id}/comments/{comment-public-id}/reactions';
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
