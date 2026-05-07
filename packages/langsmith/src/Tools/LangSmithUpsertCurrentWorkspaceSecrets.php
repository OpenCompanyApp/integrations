<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Upsert Current Workspace Secrets.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/workspaces/current/secrets.
 */
class LangSmithUpsertCurrentWorkspaceSecrets extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_upsert_current_workspace_secrets';
    protected const DESCRIPTION = 'Upsert Current Workspace Secrets

Official endpoint: POST /api/v1/workspaces/current/secrets
Upsert Current Workspace Secrets.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/workspaces/current/secrets';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
