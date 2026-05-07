<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Get Epic Comment.
 *
 * Maps to the official Shortcut endpoint GET /api/v3/epics/{epic-public-id}/comments/{comment-public-id}.
 */
class ShortcutGetEpicComment extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_get_epic_comment';
    protected const DESCRIPTION = 'Get Epic Comment

Official Shortcut endpoint: GET /api/v3/epics/{epic-public-id}/comments/{comment-public-id}.';
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
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/epics/{epic-public-id}/comments/{comment-public-id}';
    protected const PATH_PARAMS = [
        'epic-public-id' => 'epic_public_id',
        'comment-public-id' => 'comment_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
