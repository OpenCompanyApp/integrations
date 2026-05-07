<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Update Epic Comment.
 *
 * Maps to the official Shortcut endpoint PUT /api/v3/epics/{epic-public-id}/comments/{comment-public-id}.
 */
class ShortcutUpdateEpicComment extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_update_epic_comment';
    protected const DESCRIPTION = 'Update Epic Comment

Official Shortcut endpoint: PUT /api/v3/epics/{epic-public-id}/comments/{comment-public-id}.';
    protected const PARAMETERS = [
        'epic_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The ID of the associated Epic.',
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
    protected const METHOD = 'PUT';
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
