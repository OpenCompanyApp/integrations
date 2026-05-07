<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Create Epic Comment.
 *
 * Maps to the official Shortcut endpoint POST /api/v3/epics/{epic-public-id}/comments.
 */
class ShortcutCreateEpicComment extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_create_epic_comment';
    protected const DESCRIPTION = 'Create Epic Comment

Official Shortcut endpoint: POST /api/v3/epics/{epic-public-id}/comments.';
    protected const PARAMETERS = [
        'epic_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The ID of the associated Epic.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Shortcut API schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v3/epics/{epic-public-id}/comments';
    protected const PATH_PARAMS = [
        'epic-public-id' => 'epic_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}
