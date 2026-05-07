<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List Repo Owners.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/repos/{owner}/{repo}/owners.
 */
class LangSmithListRepoOwners extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_list_repo_owners';
    protected const DESCRIPTION = 'List Repo Owners

Official endpoint: GET /api/v1/repos/{owner}/{repo}/owners
List all owners of a repo. Requires read permission on the repo.';
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
    protected const PATH = '/api/v1/repos/{owner}/{repo}/owners';
    protected const PATH_PARAMS = array (
  0 => 'owner',
  1 => 'repo',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
