<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Claim Pending Workspace Invite.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/workspaces/pending/{workspace_id}/claim.
 */
class LangSmithClaimPendingWorkspaceInvite extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_claim_pending_workspace_invite';
    protected const DESCRIPTION = 'Claim Pending Workspace Invite

Official endpoint: POST /api/v1/workspaces/pending/{workspace_id}/claim
Claim Pending Workspace Invite.';
    protected const PARAMETERS = array (
  'workspace_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `workspace_id`.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/workspaces/pending/{workspace_id}/claim';
    protected const PATH_PARAMS = array (
  0 => 'workspace_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
