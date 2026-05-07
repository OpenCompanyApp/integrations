<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Current Workspace Members.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/workspaces/current/members.
 */
class LangSmithGetCurrentWorkspaceMembers extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_current_workspace_members';
    protected const DESCRIPTION = 'Get Current Workspace Members

Official endpoint: GET /api/v1/workspaces/current/members
Get Current Workspace Members.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/workspaces/current/members';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
