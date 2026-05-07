<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete Pending Workspace Invite.
 *
 * Maps to the official LangSmith endpoint DELETE /api/v1/workspaces/pending/{id}.
 */
class LangSmithDeletePendingWorkspaceInvite extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_pending_workspace_invite';
    protected const DESCRIPTION = 'Delete Pending Workspace Invite

Official endpoint: DELETE /api/v1/workspaces/pending/{id}
Delete Pending Workspace Invite.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v1/workspaces/pending/{id}';
    protected const PATH_PARAMS = array (
  0 => 'id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
