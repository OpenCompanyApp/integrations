<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Unlink Comment thread from Slack.
 *
 * Maps to the official Shortcut endpoint POST /api/v3/stories/{story-public-id}/comments/{comment-public-id}/unlink-from-slack.
 */
class ShortcutUnlinkCommentThreadFromSlack extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_unlink_comment_thread_from_slack';
    protected const DESCRIPTION = 'Unlink Comment thread from Slack

Official Shortcut endpoint: POST /api/v3/stories/{story-public-id}/comments/{comment-public-id}/unlink-from-slack.';
    protected const PARAMETERS = [
        'story_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The ID of the Story to unlink.',
        ],
        'comment_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The ID of the Comment to unlink.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v3/stories/{story-public-id}/comments/{comment-public-id}/unlink-from-slack';
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
