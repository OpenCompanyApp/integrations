<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List tools.
 *
 * Maps to the official LangSmith endpoint GET /v1/platform/tools.
 */
class LangSmithGetV1PlatformTools extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_v1_platform_tools';
    protected const DESCRIPTION = 'List tools

Official endpoint: GET /v1/platform/tools
Returns a paginated list of tools in the workspace.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `query`.',
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
    protected const PATH = '/v1/platform/tools';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'limit',
  1 => 'offset',
  2 => 'query',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
