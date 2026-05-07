<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete Repos.
 *
 * Maps to the official LangSmith endpoint DELETE /api/v1/repos.
 */
class LangSmithDeleteRepos extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_repos';
    protected const DESCRIPTION = 'Delete Repos

Official endpoint: DELETE /api/v1/repos
Delete multiple repos with partial success support. Returns: - 200: All repos deleted successfully - 207: Some repos deleted successfully, some failed';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: repo_ids.',
  ),
  'repo_ids' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `repo_ids`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v1/repos';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'repo_ids',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
