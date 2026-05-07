<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete Current Workspace Pending Member.
 *
 * Maps to the official LangSmith endpoint DELETE /api/v1/workspaces/current/members/{identity_id}/pending.
 */
class LangSmithDeleteCurrentWorkspacePendingMember extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_current_workspace_pending_member';
    protected const DESCRIPTION = 'Delete Current Workspace Pending Member

Official endpoint: DELETE /api/v1/workspaces/current/members/{identity_id}/pending
Delete Current Workspace Pending Member.';
    protected const PARAMETERS = array (
  'identity_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `identity_id`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v1/workspaces/current/members/{identity_id}/pending';
    protected const PATH_PARAMS = array (
  0 => 'identity_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
