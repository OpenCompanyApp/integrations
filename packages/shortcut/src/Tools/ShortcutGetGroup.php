<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Get Group.
 *
 * Maps to the official Shortcut endpoint GET /api/v3/groups/{group-public-id}.
 */
class ShortcutGetGroup extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_get_group';
    protected const DESCRIPTION = 'Get Group

Official Shortcut endpoint: GET /api/v3/groups/{group-public-id}.';
    protected const PARAMETERS = [
        'group_public_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The unique ID of the Group.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/groups/{group-public-id}';
    protected const PATH_PARAMS = [
        'group-public-id' => 'group_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
