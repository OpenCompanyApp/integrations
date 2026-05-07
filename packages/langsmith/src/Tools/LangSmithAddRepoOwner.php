<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Add Repo Owner.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/repos/{owner}/{repo}/owners.
 */
class LangSmithAddRepoOwner extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_add_repo_owner';
    protected const DESCRIPTION = 'Add Repo Owner

Official endpoint: POST /api/v1/repos/{owner}/{repo}/owners
Add an owner to a repo. Requires being an existing owner of the repo.';
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
    protected const METHOD = 'POST';
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
