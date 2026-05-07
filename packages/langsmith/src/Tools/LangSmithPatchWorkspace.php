<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Patch Workspace.
 *
 * Maps to the official LangSmith endpoint PATCH /api/v1/workspaces/{workspace_id}.
 */
class LangSmithPatchWorkspace extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_patch_workspace';
    protected const DESCRIPTION = 'Patch Workspace

Official endpoint: PATCH /api/v1/workspaces/{workspace_id}
Update a workspace.';
    protected const PARAMETERS = array (
  'workspace_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `workspace_id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/api/v1/workspaces/{workspace_id}';
    protected const PATH_PARAMS = array (
  0 => 'workspace_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
