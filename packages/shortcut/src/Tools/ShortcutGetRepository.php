<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Get Repository.
 *
 * Maps to the official Shortcut endpoint GET /api/v3/repositories/{repo-public-id}.
 */
class ShortcutGetRepository extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_get_repository';
    protected const DESCRIPTION = 'Get Repository

Official Shortcut endpoint: GET /api/v3/repositories/{repo-public-id}.';
    protected const PARAMETERS = [
        'repo_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The unique ID of the Repository.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/repositories/{repo-public-id}';
    protected const PATH_PARAMS = [
        'repo-public-id' => 'repo_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
