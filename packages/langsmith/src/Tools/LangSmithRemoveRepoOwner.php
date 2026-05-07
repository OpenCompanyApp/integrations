<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Remove Repo Owner.
 *
 * Maps to the official LangSmith endpoint DELETE /api/v1/repos/{owner}/{repo}/owners.
 */
class LangSmithRemoveRepoOwner extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_remove_repo_owner';
    protected const DESCRIPTION = 'Remove Repo Owner

Official endpoint: DELETE /api/v1/repos/{owner}/{repo}/owners
Remove an owner from a repo. Requires being an existing owner of the repo.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v1/repos/{owner}/{repo}/owners';
    protected const PATH_PARAMS = array (
  0 => 'owner',
  1 => 'repo',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
