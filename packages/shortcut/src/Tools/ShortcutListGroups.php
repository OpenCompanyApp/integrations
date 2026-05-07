<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * List Groups.
 *
 * Maps to the official Shortcut endpoint GET /api/v3/groups.
 */
class ShortcutListGroups extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_list_groups';
    protected const DESCRIPTION = 'List Groups

Official Shortcut endpoint: GET /api/v3/groups.';
    protected const PARAMETERS = [
        'archived' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'Filter groups by their archived state. If true, returns only archived groups. If false, returns only unarchived groups. If not provided, returns all groups',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/groups';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'archived' => 'archived',
    ];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
