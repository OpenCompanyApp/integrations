<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete Repo.
 *
 * Maps to the official LangSmith endpoint DELETE /api/v1/repos/{owner}/{repo}.
 */
class LangSmithDeleteRepo extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_repo';
    protected const DESCRIPTION = 'Delete Repo

Official endpoint: DELETE /api/v1/repos/{owner}/{repo}
Delete a repo.';
    protected const PARAMETERS = array (
  'owner' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `owner`.',
  ),
  'repo' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `repo`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v1/repos/{owner}/{repo}';
    protected const PATH_PARAMS = array (
  0 => 'owner',
  1 => 'repo',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
