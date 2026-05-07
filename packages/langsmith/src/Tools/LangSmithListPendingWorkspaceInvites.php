<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List Pending Workspace Invites.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/workspaces/pending.
 */
class LangSmithListPendingWorkspaceInvites extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_list_pending_workspace_invites';
    protected const DESCRIPTION = 'List Pending Workspace Invites

Official endpoint: GET /api/v1/workspaces/pending
Get all workspaces visible to this auth';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/workspaces/pending';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
