<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Shared Tokens.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/workspaces/current/shared.
 */
class LangSmithGetSharedTokens extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_shared_tokens';
    protected const DESCRIPTION = 'Get Shared Tokens

Official endpoint: GET /api/v1/workspaces/current/shared
List all shared entities and their tokens by the workspace.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: limit, offset.',
  ),
  'limit' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `limit`.',
  ),
  'offset' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `offset`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/workspaces/current/shared';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'limit',
  1 => 'offset',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
