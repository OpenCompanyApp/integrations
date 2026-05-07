<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Tools.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/mcp/tools.
 */
class LangSmithGetTools extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_tools';
    protected const DESCRIPTION = 'Get Tools

Official endpoint: GET /api/v1/mcp/tools
Return MCP tools — from cache if fresh, otherwise by fetching from remote. On cache miss, tries manifest fetch first (fast), then falls back to full MCP handshake. Caches the result before returning. Pass force_refresh=true to bypass the cache and always fetch from the remote server (the result is still cached via upsert for future requests). The ls_user_id query parameter allows service-key callers (which don\'t...';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: url, oauth_provider_id, ls_user_id, force_refresh.',
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
  'force_refresh' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `force_refresh`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/mcp/tools';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'url',
  1 => 'oauth_provider_id',
  2 => 'ls_user_id',
  3 => 'force_refresh',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
