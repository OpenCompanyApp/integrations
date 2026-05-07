<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Create Group.
 *
 * Maps to the official Shortcut endpoint POST /api/v3/groups.
 */
class ShortcutCreateGroup extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_create_group';
    protected const DESCRIPTION = 'Create Group

Official Shortcut endpoint: POST /api/v3/groups.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Shortcut API schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v3/groups';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}
