<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Patch Current Workspace Member.
 *
 * Maps to the official LangSmith endpoint PATCH /api/v1/workspaces/current/members/{identity_id}.
 */
class LangSmithPatchCurrentWorkspaceMember extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_patch_current_workspace_member';
    protected const DESCRIPTION = 'Patch Current Workspace Member

Official endpoint: PATCH /api/v1/workspaces/current/members/{identity_id}
Patch Current Workspace Member.';
    protected const PARAMETERS = array (
  'identity_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `identity_id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/api/v1/workspaces/current/members/{identity_id}';
    protected const PATH_PARAMS = array (
  0 => 'identity_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
