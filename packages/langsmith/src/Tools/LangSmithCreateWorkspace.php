<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create Workspace.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/workspaces.
 */
class LangSmithCreateWorkspace extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_create_workspace';
    protected const DESCRIPTION = 'Create Workspace

Official endpoint: POST /api/v1/workspaces
Create a new workspace.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/workspaces';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
