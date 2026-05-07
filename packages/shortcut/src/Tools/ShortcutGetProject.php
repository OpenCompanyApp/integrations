<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Get Project.
 *
 * Maps to the official Shortcut endpoint GET /api/v3/projects/{project-public-id}.
 */
class ShortcutGetProject extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_get_project';
    protected const DESCRIPTION = 'Get Project

Official Shortcut endpoint: GET /api/v3/projects/{project-public-id}.';
    protected const PARAMETERS = [
        'project_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The unique ID of the Project.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/projects/{project-public-id}';
    protected const PATH_PARAMS = [
        'project-public-id' => 'project_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
