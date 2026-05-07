<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Invalidate Tools Cache.
 *
 * Maps to the official LangSmith endpoint DELETE /api/v1/mcp/tools.
 */
class LangSmithInvalidateToolsCache extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_invalidate_tools_cache';
    protected const DESCRIPTION = 'Invalidate Tools Cache

Official endpoint: DELETE /api/v1/mcp/tools
Invalidate cached MCP tools for a given server URL. Called when a tool call fails with a stale-tools error, so subsequent requests to GET /mcp/tools will re-fetch from the remote server.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: url, oauth_provider_id, ls_user_id.',
  ),
  'url' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `url`.',
  ),
  'oauth_provider_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `oauth_provider_id`.',
  ),
  'ls_user_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `ls_user_id`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v1/mcp/tools';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'url',
  1 => 'oauth_provider_id',
  2 => 'ls_user_id',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
