<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Get Current Member Info.
 *
 * Maps to the official Shortcut endpoint GET /api/v3/member.
 */
class ShortcutGetCurrentMemberInfo extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_get_current_member_info';
    protected const DESCRIPTION = 'Get Current Member Info

Official Shortcut endpoint: GET /api/v3/member.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/member';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
