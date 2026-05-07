<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Story History.
 *
 * Maps to the official Shortcut endpoint GET /api/v3/stories/{story-public-id}/history.
 */
class ShortcutStoryHistory extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_story_history';
    protected const DESCRIPTION = 'Story History

Official Shortcut endpoint: GET /api/v3/stories/{story-public-id}/history.';
    protected const PARAMETERS = [
        'story_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The ID of the Story.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/stories/{story-public-id}/history';
    protected const PATH_PARAMS = [
        'story-public-id' => 'story_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
