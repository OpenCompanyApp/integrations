<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Add Members To Current Workspace Batch.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/workspaces/current/members/batch.
 */
class LangSmithAddMembersToCurrentWorkspaceBatch extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_add_members_to_current_workspace_batch';
    protected const DESCRIPTION = 'Add Members To Current Workspace Batch

Official endpoint: POST /api/v1/workspaces/current/members/batch
Batch invite up to 500 users to the current workspace and organization.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/workspaces/current/members/batch';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
