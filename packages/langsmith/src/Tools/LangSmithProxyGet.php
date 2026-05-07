<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Proxy Get.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/mcp/proxy.
 */
class LangSmithProxyGet extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_proxy_get';
    protected const DESCRIPTION = 'Proxy Get

Official endpoint: GET /api/v1/mcp/proxy
Proxy Get.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: url, accept_stream, timeout.',
  ),
  'url' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `url`.',
  ),
  'accept_stream' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `accept_stream`.',
  ),
  'timeout' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `timeout`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/mcp/proxy';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'url',
  1 => 'accept_stream',
  2 => 'timeout',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
