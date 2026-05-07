<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Create Epic Comment Comment.
 *
 * Maps to the official Shortcut endpoint POST /api/v3/epics/{epic-public-id}/comments/{comment-public-id}.
 */
class ShortcutCreateEpicCommentComment extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_create_epic_comment_comment';
    protected const DESCRIPTION = 'Create Epic Comment Comment

Official Shortcut endpoint: POST /api/v3/epics/{epic-public-id}/comments/{comment-public-id}.';
    protected const PARAMETERS = [
        'epic_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The ID of the associated Epic.',
        ],
        'comment_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The ID of the parent Epic Comment.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Shortcut API schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v3/epics/{epic-public-id}/comments/{comment-public-id}';
    protected const PATH_PARAMS = [
        'epic-public-id' => 'epic_public_id',
        'comment-public-id' => 'comment_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}
