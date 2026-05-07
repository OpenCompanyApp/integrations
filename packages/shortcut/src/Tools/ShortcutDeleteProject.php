<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Delete Project.
 *
 * Maps to the official Shortcut endpoint DELETE /api/v3/projects/{project-public-id}.
 */
class ShortcutDeleteProject extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_delete_project';
    protected const DESCRIPTION = 'Delete Project

Official Shortcut endpoint: DELETE /api/v3/projects/{project-public-id}.';
    protected const PARAMETERS = [
        'project_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The unique ID of the Project.',
        ],
    ];
    protected const METHOD = 'DELETE';
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
