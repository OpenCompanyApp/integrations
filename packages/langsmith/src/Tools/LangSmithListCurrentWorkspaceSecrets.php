<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List Current Workspace Secrets.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/workspaces/current/secrets.
 */
class LangSmithListCurrentWorkspaceSecrets extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_list_current_workspace_secrets';
    protected const DESCRIPTION = 'List Current Workspace Secrets

Official endpoint: GET /api/v1/workspaces/current/secrets
List Current Workspace Secrets.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/workspaces/current/secrets';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
