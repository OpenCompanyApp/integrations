<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Update Group.
 *
 * Maps to the official Shortcut endpoint PUT /api/v3/groups/{group-public-id}.
 */
class ShortcutUpdateGroup extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_update_group';
    protected const DESCRIPTION = 'Update Group

Official Shortcut endpoint: PUT /api/v3/groups/{group-public-id}.';
    protected const PARAMETERS = [
        'group_public_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The unique ID of the Group.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Shortcut API schema.',
        ],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/api/v3/groups/{group-public-id}';
    protected const PATH_PARAMS = [
        'group-public-id' => 'group_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}
