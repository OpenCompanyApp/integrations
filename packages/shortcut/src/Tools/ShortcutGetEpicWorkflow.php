<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Get Epic Workflow.
 *
 * Maps to the official Shortcut endpoint GET /api/v3/epic-workflow.
 */
class ShortcutGetEpicWorkflow extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_get_epic_workflow';
    protected const DESCRIPTION = 'Get Epic Workflow

Official Shortcut endpoint: GET /api/v3/epic-workflow.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/epic-workflow';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
