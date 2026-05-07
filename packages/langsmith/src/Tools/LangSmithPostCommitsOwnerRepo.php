<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create a commit.
 *
 * Maps to the official LangSmith endpoint POST /commits/{owner}/{repo}.
 */
class LangSmithPostCommitsOwnerRepo extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_commits_owner_repo';
    protected const DESCRIPTION = 'Create a commit

Official endpoint: POST /commits/{owner}/{repo}
Creates a new commit in a repository. Requires authentication and write access to the repository.';
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
    protected const PATH = '/commits/{owner}/{repo}';
    protected const PATH_PARAMS = array (
  0 => 'owner',
  1 => 'repo',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
