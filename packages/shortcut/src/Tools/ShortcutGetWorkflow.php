<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Get Workflow.
 *
 * Maps to the official Shortcut endpoint GET /api/v3/workflows/{workflow-public-id}.
 */
class ShortcutGetWorkflow extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_get_workflow';
    protected const DESCRIPTION = 'Get Workflow

Official Shortcut endpoint: GET /api/v3/workflows/{workflow-public-id}.';
    protected const PARAMETERS = [
        'workflow_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The ID of the Workflow.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/workflows/{workflow-public-id}';
    protected const PATH_PARAMS = [
        'workflow-public-id' => 'workflow_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
