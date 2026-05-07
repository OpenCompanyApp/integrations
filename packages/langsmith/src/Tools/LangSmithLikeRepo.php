<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Like Repo.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/likes/{owner}/{repo}.
 */
class LangSmithLikeRepo extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_like_repo';
    protected const DESCRIPTION = 'Like Repo

Official endpoint: POST /api/v1/likes/{owner}/{repo}
Like a repo.';
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
    protected const PATH = '/api/v1/likes/{owner}/{repo}';
    protected const PATH_PARAMS = array (
  0 => 'owner',
  1 => 'repo',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
