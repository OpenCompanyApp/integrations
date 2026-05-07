<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Update workspace TTL settings.
 *
 * Maps to the official LangSmith endpoint PUT /workspaces/current/ttl-settings.
 */
class LangSmithPutWorkspacesCurrentTtlSettings extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_put_workspaces_current_ttl_settings';
    protected const DESCRIPTION = 'Update workspace TTL settings

Official endpoint: PUT /workspaces/current/ttl-settings
Update the longlived trace TTL for a workspace.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'PUT';
    protected const PATH = '/workspaces/current/ttl-settings';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
