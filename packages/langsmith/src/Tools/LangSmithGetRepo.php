<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Repo.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/repos/{owner}/{repo}.
 */
class LangSmithGetRepo extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_repo';
    protected const DESCRIPTION = 'Get Repo

Official endpoint: GET /api/v1/repos/{owner}/{repo}
Get a repo.';
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
    protected const METHOD = 'GET';
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
