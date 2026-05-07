<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Update Repo.
 *
 * Maps to the official LangSmith endpoint PATCH /api/v1/repos/{owner}/{repo}.
 */
class LangSmithUpdateRepo extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_update_repo';
    protected const DESCRIPTION = 'Update Repo

Official endpoint: PATCH /api/v1/repos/{owner}/{repo}
Update a repo.';
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
    protected const METHOD = 'PATCH';
    protected const PATH = '/api/v1/repos/{owner}/{repo}';
    protected const PATH_PARAMS = array (
  0 => 'owner',
  1 => 'repo',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
