<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Update Project.
 *
 * Maps to the official Shortcut endpoint PUT /api/v3/projects/{project-public-id}.
 */
class ShortcutUpdateProject extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_update_project';
    protected const DESCRIPTION = 'Update Project

Official Shortcut endpoint: PUT /api/v3/projects/{project-public-id}.';
    protected const PARAMETERS = [
        'project_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The unique ID of the Project.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Shortcut API schema.',
        ],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/api/v3/projects/{project-public-id}';
    protected const PATH_PARAMS = [
        'project-public-id' => 'project_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}
