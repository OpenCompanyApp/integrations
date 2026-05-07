<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Get Member.
 *
 * Maps to the official Shortcut endpoint GET /api/v3/members/{member-public-id}.
 */
class ShortcutGetMember extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_get_member';
    protected const DESCRIPTION = 'Get Member

Official Shortcut endpoint: GET /api/v3/members/{member-public-id}.';
    protected const PARAMETERS = [
        'member_public_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The Member\'s unique ID.',
        ],
        'org_public_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'The unique ID of the Organization to limit the lookup to.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/members/{member-public-id}';
    protected const PATH_PARAMS = [
        'member-public-id' => 'member_public_id',
    ];
    protected const QUERY_PARAMS = [
        'org-public-id' => 'org_public_id',
    ];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
