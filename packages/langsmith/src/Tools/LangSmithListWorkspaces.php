<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List Workspaces.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/workspaces.
 */
class LangSmithListWorkspaces extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_list_workspaces';
    protected const DESCRIPTION = 'List Workspaces

Official endpoint: GET /api/v1/workspaces
Get all workspaces visible to this auth in the current org. Does not create a new workspace/org.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: include_deleted.',
  ),
  'include_deleted' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `include_deleted`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/workspaces';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'include_deleted',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
