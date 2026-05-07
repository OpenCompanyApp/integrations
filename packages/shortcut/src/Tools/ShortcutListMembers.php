<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * List Members.
 *
 * Maps to the official Shortcut endpoint GET /api/v3/members.
 */
class ShortcutListMembers extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_list_members';
    protected const DESCRIPTION = 'List Members

Official Shortcut endpoint: GET /api/v3/members.';
    protected const PARAMETERS = [
        'org_public_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'The unique ID of the Organization to limit the list to.',
        ],
        'disabled' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'Filter members by their disabled state. If true, return only disabled members. If false, return only enabled members.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/members';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'org-public-id' => 'org_public_id',
        'disabled' => 'disabled',
    ];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
