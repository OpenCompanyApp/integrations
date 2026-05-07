<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * List Group Stories.
 *
 * Maps to the official Shortcut endpoint GET /api/v3/groups/{group-public-id}/stories.
 */
class ShortcutListGroupStories extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_list_group_stories';
    protected const DESCRIPTION = 'List Group Stories

Official Shortcut endpoint: GET /api/v3/groups/{group-public-id}/stories.';
    protected const PARAMETERS = [
        'group_public_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The unique ID of the Group.',
        ],
        'limit' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'The maximum number of results to return. (Defaults to 1000, max 1000)',
        ],
        'offset' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'The offset at which to begin returning results. (Defaults to 0)',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/groups/{group-public-id}/stories';
    protected const PATH_PARAMS = [
        'group-public-id' => 'group_public_id',
    ];
    protected const QUERY_PARAMS = [
        'limit' => 'limit',
        'offset' => 'offset',
    ];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
