<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete Workspace.
 *
 * Maps to the official LangSmith endpoint DELETE /api/v1/workspaces/{workspace_id}.
 */
class LangSmithDeleteWorkspace extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_workspace';
    protected const DESCRIPTION = 'Delete Workspace

Official endpoint: DELETE /api/v1/workspaces/{workspace_id}
Delete Workspace.';
    protected const PARAMETERS = array (
  'workspace_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `workspace_id`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v1/workspaces/{workspace_id}';
    protected const PATH_PARAMS = array (
  0 => 'workspace_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
